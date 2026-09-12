---
name: text-writing
description: Apply HosonoDE natural writing style guardrails when writing, rewriting, or editing prose such as emails, documentation, newsletters, blogs, landing pages, client messages, analyses, or comments. Select this skill in Cursor, Codex, or Antigravity for text-writing tasks. Do not use it as the only instruction for image-only generation, code-only work, or strict translations.
disable-model-invocation: true
---

# Text Writing

Follow these guardrails whenever this skill is selected and the output is written prose.

Canonical wording lives in the HosonoDE Prompt Library: [Natural Writing Style Guardrails](https://github.com/HosonoDE/HosonoDE-Prompt-Library/blob/main/prompts/writing/style-guardrails/natural-writing-style-guardrails.md). If this overlay causes problems, tell Ryusei. Change the Prompt Library first, then copy the same wording into this skill in every project. Do not invent a local variant.

Keep the task-specific brief, brand rules, facts, and required format. This skill is a style overlay, not a replacement for the writing assignment.

Skip this overlay when the job is image-only generation, code-only work, or a strict translation that must stay close to the source, unless the model is also drafting new prose.

## Guardrails

Write naturally and avoid patterns that make text sound formulaic or obviously AI-generated. These are guidelines, not absolute rules. Use such patterns when explicitly requested or genuinely appropriate, but avoid unnecessary repetition and default use.

* Avoid repeatedly using constructions like **"not X, but Y"**, **"not only X, but also Y"**, or **"more than just X."**
* Do not default to groups of exactly three points, benefits, adjectives, or arguments.
* When replying to a client or another person's message, do not open by restating, paraphrasing, summarizing, or validating what they just said unless clarification is genuinely needed. Start with the actual answer, response, decision, or next step.
* Avoid generic AI-style wording such as **crucial, pivotal, robust, transformative, landscape, ecosystem, underscore, delve** when simpler language works better.
* Avoid generic introductions, filler, and obvious statements that add little information.
* Do not repeatedly explain that something **"highlights," "underscores," or "demonstrates the importance of"** something already clear.
* Only use em dashes, rhetorical questions, sentence fragments, and punch-line constructions only if really necessary.
* Avoid overly regular structure. Do not make every response follow the same **introduction → explanation → examples → conclusion** pattern.
* Vary sentence and paragraph length naturally instead of making the text uniformly structured.
* Avoid repeating the same idea in different words or cycling through synonyms just to sound varied.
* Use transitions such as **however, moreover, additionally, ultimately** only when they improve the flow, not as default paragraph starters.
* Avoid unnecessary meta-phrases such as **"It is important to note"**, **"The key takeaway is"**, or **"What does this mean?"**
* Prefer concrete, specific wording over generic statements, vague abstractions, or artificial marketing language.
* Do not automatically add summaries, conclusions, headings, bullet lists, bold text, or numbered frameworks unless they improve the requested output.
* Avoid excessive hedging or artificially balanced arguments when a clearer position is justified.
* Preserve the intended voice, formality, domain language, and cultural style instead of normalizing everything into a generic assistant tone.
* Evaluate these patterns collectively. A single occurrence is usually fine; repeated combinations are what make text feel AI-generated.
* If the user explicitly requests a style that naturally uses these patterns, follow that instruction.
