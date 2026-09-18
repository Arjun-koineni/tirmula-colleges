"""
Anthropic API Client Configuration & Verification Script
Reads configuration from .env or default environment and tests connection to the endpoint.
"""
import os
import json
import urllib.request
import urllib.error

# 1. Load variables from .env if present
def load_env(env_path=".env"):
    if not os.path.exists(env_path):
        return {}
    env_vars = {}
    with open(env_path, "r", encoding="utf-8") as f:
        for line in f:
            line = line.strip()
            if not line or line.startswith("#"):
                continue
            if "=" in line:
                key, val = line.split("=", 1)
                key = key.strip()
                val = val.strip().strip('"').strip("'")
                env_vars[key] = val
                os.environ[key] = val
    return env_vars

env = load_env()

BASE_URL = os.getenv("ANTHROPIC_BASE_URL", "http://localhost:20128/v1").rstrip("/")
AUTH_TOKEN = os.getenv("ANTHROPIC_AUTH_TOKEN", "sk-43a005ca9d8087ea-0dc688-56f1c437")
MODEL_NAME = os.getenv("ANTHROPIC_MODEL", "auto/claude-opus")

print("=" * 60)
print("ANTHROPIC CLIENT CONFIGURATION")
print("=" * 60)
print(f"Base URL   : {BASE_URL}")
print(f"Model      : {MODEL_NAME}")
print(f"Auth Token : {AUTH_TOKEN[:8]}...{AUTH_TOKEN[-6:] if len(AUTH_TOKEN) > 14 else ''}")
print("=" * 60)

# 2. How to use with the official `anthropic` Python SDK:
sdk_code_example = f'''
# --- Using the official anthropic package ---
# pip install anthropic
import anthropic

client = anthropic.Anthropic(
    base_url="{BASE_URL}",
    api_key="{AUTH_TOKEN}",
)

message = client.messages.create(
    model="{MODEL_NAME}",
    max_tokens=1024,
    messages=[
        {{"role": "user", "content": "Hello! Please confirm you are working."}}
    ]
)
print(message.content[0].text)
'''

print("\n--- Example: SDK Usage ---")
print(sdk_code_example)

# 3. Direct HTTP Request (Zero external dependencies):
def test_connection():
    print("Testing connection to endpoint...")
    endpoint = f"{BASE_URL}/messages"
    payload = {
        "model": MODEL_NAME,
        "max_tokens": 100,
        "messages": [
            {"role": "user", "content": "Ping test: are you active?"}
        ]
    }
    
    headers = {
        "Content-Type": "application/json",
        "x-api-key": AUTH_TOKEN,
        "Authorization": f"Bearer {AUTH_TOKEN}",
        "anthropic-version": "2023-06-01"
    }

    req = urllib.request.Request(
        endpoint,
        data=json.dumps(payload).encode("utf-8"),
        headers=headers,
        method="POST"
    )

    try:
        with urllib.request.urlopen(req, timeout=5) as response:
            res_data = json.loads(response.read().decode("utf-8"))
            print(" Connection successful!")
            print("Response:", json.dumps(res_data, indent=2))
    except urllib.error.URLError as e:
        print(f" Connection notice: Unable to reach {endpoint} ({e}).")
        print("  Make sure your local proxy server is running at", BASE_URL)

if __name__ == "__main__":
    test_connection()
