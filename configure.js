/**
 * Anthropic API Client Configuration (Node.js)
 * Using @anthropic-ai/sdk or direct fetch
 */
import Anthropic from '@anthropic-ai/sdk';
import 'dotenv/config';

const anthropic = new Anthropic({
  baseURL: process.env.ANTHROPIC_BASE_URL || 'http://localhost:20128/v1',
  apiKey: process.env.ANTHROPIC_AUTH_TOKEN || 'sk-43a005ca9d8087ea-0dc688-56f1c437',
});

async function main() {
  try {
    const response = await anthropic.messages.create({
      model: process.env.ANTHROPIC_MODEL || 'auto/claude-opus',
      max_tokens: 1024,
      messages: [{ role: 'user', content: 'Hello! Please confirm connection.' }],
    });
    console.log('Response:', response.content[0].text);
  } catch (err) {
    console.error('Connection error:', err.message);
  }
}

main();
