// Checks every page we deliver goes through, run against the theme on a local WordPress (npm start):
//   - axe: no WCAG 2.2 A/AA violations
//   - no sideways scroll at phone, tablet and desktop widths
//   - exactly one H1, and headings never skip a level
//   - every image has an alt attribute; every link and button has a name
//   - pinch zoom is not disabled
// Screenshots at the three widths go to tests/screenshots/ for a side-by-side check against the design.
import { chromium } from "playwright";
import AxeBuilder from "@axe-core/playwright";
import { mkdirSync } from "node:fs";

const BASE = process.env.BASE_URL || "http://127.0.0.1:9400";
const PAGES = ["/", "/?p=1", "/this-page-does-not-exist"];
const WIDTHS = { phone: 390, tablet: 820, desktop: 1440 };

mkdirSync("tests/screenshots", { recursive: true });
process.on("unhandledRejection", (e) => {
	if (process.env.GITHUB_ACTIONS) console.log(`::error title=Page check crashed::${currentPath} ${String(e).split("\n")[0]}`);
	console.error(e);
	process.exit(1);
});
const browser = await chromium.launch();
let failures = 0;
// On GitHub, each problem is also an annotation, so it shows on the commit without opening the log.
const fail = (msg) => {
	failures++;
	console.log(`  ✗ ${msg}`);
	if (process.env.GITHUB_ACTIONS) console.log(`::error title=Page check::${currentPath} ${msg}`);
};
let currentPath = "";

for (const path of PAGES) {
	currentPath = path;
	console.log(path);
	for (const [name, width] of Object.entries(WIDTHS)) {
		const context = await browser.newContext({ viewport: { width, height: 900 } });
		const page = await context.newPage();
		await page.goto(BASE + path, { waitUntil: "networkidle" });

		const facts = await page.evaluate(() => {
			const levels = [...document.querySelectorAll("h1,h2,h3,h4,h5,h6")].map((h) => Number(h.tagName[1]));
			const skips = levels.filter((l, i) => i > 0 && l > levels[i - 1] + 1).length;
			return {
				overflow: document.documentElement.scrollWidth - window.innerWidth,
				h1: levels.filter((l) => l === 1).length,
				skips,
				noAlt: [...document.images].filter((img) => !img.hasAttribute("alt")).length,
				zoomBlocked: /user-scalable\s*=\s*(no|0)|maximum-scale\s*=\s*1(\.0)?\b/i.test(document.querySelector('meta[name="viewport"]')?.content || ""),
			};
		});
		if (facts.overflow > 1) fail(`${name}: scrolls sideways by ${facts.overflow}px`);
		if (facts.h1 !== 1) fail(`${name}: ${facts.h1} H1 headings`);
		if (facts.skips) fail(`${name}: heading levels skip ${facts.skips} time(s)`);
		if (facts.noAlt) fail(`${name}: ${facts.noAlt} image(s) without alt`);
		if (facts.zoomBlocked) fail(`${name}: pinch zoom disabled`);

		if (name === "phone" || name === "desktop") {
			const { violations } = await new AxeBuilder({ page }).withTags(["wcag2a", "wcag2aa", "wcag21a", "wcag21aa", "wcag22aa"]).analyze();
			for (const v of violations) fail(`${name}: axe ${v.id} (${v.nodes.length}) ${v.help}`);
		}

		const slug = path === "/" ? "home" : path.replace(/[^a-z0-9]+/gi, "-").replace(/^-|-$/g, "");
		await page.screenshot({ path: `tests/screenshots/${slug}-${name}.png`, fullPage: true });
		await context.close();
	}
}

await browser.close();
console.log(failures ? `\n${failures} problem(s)` : "\nAll checks passed");
process.exit(failures ? 1 : 0);
