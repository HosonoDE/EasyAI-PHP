<?php

	namespace EasyAI\Chat\Enums;

	/**
	 * Represents the available chat models in OpenAI.
	 * You can find all models here: https://platform.openai.com/docs/models
	 */
	enum OpenAIChatModel
	{
		case Gpt35Turbo;
		case Gpt4;
		case Gpt4TurboPreview;
		case Gpt4Turbo;
		case Gpt4o;
		case Gpt4oMini;
		case O1Preview;
		case O1Mini;

		public function getModelName(): string
		{
			return match ($this) {
				OpenAIChatModel::Gpt35Turbo => 'gpt-3.5-turbo', // Cost-effective and efficient model for standard text processing.
				OpenAIChatModel::Gpt4 => 'gpt-4', // Advanced model with improved understanding and longer context handling.
				OpenAIChatModel::Gpt4TurboPreview => 'gpt-4-turbo-preview', // Beta version of GPT-4 Turbo with faster response times.
				OpenAIChatModel::Gpt4Turbo => 'gpt-4-turbo', // Optimized GPT-4 version for high performance and speed.
				OpenAIChatModel::Gpt4o => 'gpt-4o', // Multimodal model supporting text, image, and audio processing.
				OpenAIChatModel::Gpt4oMini => 'gpt-4o-mini', // Smaller, cost-effective version of GPT-4o for specific tasks.
				OpenAIChatModel::O1Preview => 'o1-preview', // Model with advanced reasoning capabilities for complex tasks.
				OpenAIChatModel::O1Mini => 'o1-mini', // Faster, budget-friendly version of O1 for less resource-intensive tasks.
			};
		}
	}