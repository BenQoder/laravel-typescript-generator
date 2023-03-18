<?php

return [
    "enabled" => env("TYPESCRIPT_GENERATOR_ENABLED", false),
    "openai_api_key" => env("OPENAI_API_KEY", ""),
    "output_path" => env("TYPESCRIPT_GENERATOR_OUTPUT_PATH", ".typescript-generator")
];
