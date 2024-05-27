EasyAI-PHP
==========

About The Project
-----------------

EasyAI-PHP is an open-source initiative designed to significantly simplify the entry into artificial intelligence for PHP-developers (so basically Lang-Chain for PHP). Based on PHP 8.1+, this project integrates advanced AI models and utilities, allowing developers to incorporate complex AI functionalities with minimal coding.

Key Features
------------

*   **Multiple AI Models**: Incorporates OpenAI's GPT-3.5, GPT-4, and Claude 3 (Opus, Sonnet & Haiku), along with Gemini 1.0 & 1.5 models.
*   **AI Utilities**: Offers a variety of helpers such as vector databases from Pinecone and embeddings through OpenAI, streamlining the integration of advanced AI features into your projects.
*   **Minimal Coding Requirement**: Designed to minimize the coding effort needed on your part, thanks to the numerous ready-to-use helpers.

Getting Started
---------------

Install the project using Composer:
```
composer require hosonode/easyai-php
```

Usage
---------------

### :speech_balloon: Usage of `OpenAIChat`

Documentation: [https://hosonode.gitbook.io/easyai-php/openaichat/basic-usage](https://hosonode.gitbook.io/easyai-php/openaichat/basic-usage)

### :left_right_arrow: Usage of `EmbeddingGenerator\OpenAI`
An "embedding" is a vector representation of text that captures semantic meanings of the words or phrases. These vectors are generated by deep learning models and can be used in machine learning applications to compare texts, search for similar content, or feed into other machine learning models for tasks like classification or clustering. Each component of the vector represents a dimension of the text's meaning, allowing the model to understand and process text similarly to how humans do but in a numerical form.

Documentation: [https://hosonode.gitbook.io/easyai-php/embedding/basic-usage](https://hosonode.gitbook.io/easyai-php/embedding/basic-usage)

### :open_file_folder: Usage of `PineconeVectorStore`
The advantage of using Pinecone is that it offers a serverless package where you only pay for what you use. You don't need your own AWS, Google Cloud or Azure for this. This model is highly cost-effective as it eliminates overcapacity and unnecessary expenses.

Documentation: [https://hosonode.gitbook.io/easyai-php/pinecone/basic-usage](https://hosonode.gitbook.io/easyai-php/pinecone/basic-usage)

### Usage of `Crawler & Zyte API`

Documentation: [https://hosonode.gitbook.io/easyai-php/crawler/basic-usage](https://hosonode.gitbook.io/easyai-php/crawler/basic-usage)

### Usage of `Tools`

Documentation: [https://hosonode.gitbook.io/easyai-php/tools/basic-usage](https://hosonode.gitbook.io/easyai-php/tools/basic-usage)

:world_map: Roadmap
=======

:heavy_check_mark: Completed Features:
------------------

- [x] **OpenAI GPT-3.5 and GPT-4 Helpers**:
- [x] **Embedding Helpers**: With OpenAI
- [x] **Pinecone Vector Databases Add**: Add Vector/s Delete them
- [x] **Pinecone Vector Databases Search**: Semantic Search
- [x] **Zyte API**: With Guzzle as beginner
- [x] **DOM Crawling**: With Symfony DOM Crawler
- [x] **Tools**: AsyncHttpRequests, HTML Cleaner, HTMl Extractor, Site Type Classifier, etc.

:construction: In Progress:
-----------
- [ ] P1: **AI Translator**: With Gemini 1.0 & 1.5
- [ ] P1: **PageSpeed Insights API**:
- [ ] P1: **Gemini 1.0 & 1.5**: Text Generation
- [ ] P2: **Gemini 1.0 & 1.5**: Vision Support
- [ ] P3: **Gemini 1.0 & 1.5**: Full Multimodal support
- [ ] P2: **BunnyCDN**: Upload big files or text to CDN

:rocket: Planned Features:
----------------
- [ ] P2: **Claude 3 (Opus, Sonnet & Haiku) Helpers**:
- [ ] P2: **Embedding: AI Text Chunking**: With GPT3.5 or Claude 3 Haiku or Gimini 1.0
- [ ] P2: **Embedding: Text Chunking**: By separators and limits
- [ ] P1: **Claude 3 (Opus, Sonnet & Heiku)**: Text Generation
- [ ] P2: **Claude 3 (Opus, Sonnet & Heiku)**: Vision Support
- [ ] P2: **DALL·E 3**: Image Creationg
- [ ] P3: **AI Translator**: With DeepL
- [ ] P3: **AI Translator**: With GPT 3.5 & GPT 4
- [ ] P3: **AI Translator**: With Claude 3 (Opus, Sonnet & Heiku)
- [ ] P3: **Tokenizer for PHP**: With https://github.com/yethee/tiktoken-php
- [ ] P3: **OpenAI Whisper**: Audio Support
- [ ] P3: **Example: Pinecone semantic search tool**: UI
- [ ] P3: **Example: AI Colosseum**: Test differnt AIs with same input

FAQ
===

### Q1: Why using EasyAi-PHP and not OpenAI PHP SDK

**A1:** If you are an experienced developer and want to use many features of OpenAI, the OpenAI PHP SDK might be right for you. However, if you want to make simple requests to the OpenAI interface with very few lines of code, our repo is the right one for you, as we have programmed many helpers that you can use many AI and PHP helpers to improve your project.
Many studies and research papers also show that you should use many different AI agents to do different tasks, each AI has its strengths, weaknesses, functions, etc.. Therefore, it would be very difficult to familiarize yourself with all AIs, which is why we offer a kind of AI framework for you here.

Contributing
------------

We highly encourage community contributions. Whether you're a developer using our helpers or someone looking to enhance the functionalities of EasyAI-PHP, your contributions are welcome. This collaborative effort benefits everyone involved.

Open-Source Projects Used
-------------------------
This project utilizes several community-driven packages to power its features:

*   [openai-php/client](https://github.com/openai-php/client): For interfacing with OpenAI APIs.
*   [pinecone-php](https://github.com/probots-io/pinecone-php): For integrating vector databases.
*   [BunnyWay/BunnyCDN.PHP.Storage](https://github.com/BunnyWay/BunnyCDN.PHP.Storage): For cheap HDD & SSD storange + CDN
*   [deepl-php](https://github.com/DeepLcom/deepl-php): For translation services.
*   [LLPhant](https://github.com/theodo-group/LLPhant): An inspiration for our repo
*   [Gemini PHP](https://github.com/google-gemini-php/client): Gemini for PHP

Support
-------

For AI-related inquiries, contact our HosonoAI support at support@hosono.ai. For service-related questions, reach out to support@hosono.de. We offer support in German, English, Japanese, Russian, and Italian.

Sponsored by
------------
*   **HosonoDE**: An e-commerce agency serving mainly D-A-CH (Germany / Austria / Switzerland) customers.
*   **HosonoAI**: A platform that enables easy, code-free creation of texts for e-commerce and marketing.
