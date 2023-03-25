<?php

namespace BenQoder\TypescriptGenerator\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TypescriptGenerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (config('typescript-generator.enabled') === false) {
            return $response;
        }

        if (! str_contains($response->headers->get('Content-Type'), 'application/json')) {
            return $response;
        }

        $filename = '';

        if (! empty($request->route()->getName())) {
            $filename = 'route - '.$request->route()->getName();
        }

        if (empty($filename)) {
            $filename = 'path - '.str_replace('/', ':', $request->path());
        }

        $outputPath = config('typescript-generator.output_path');

        File::ensureDirectoryExists(base_path("{$outputPath}/{$filename}"));

        $filename = base_path("{$outputPath}/{$filename}/{$request->method()} - {$response->getStatusCode()}.ts");

        if (File::exists($filename)) {
            return $response;
        }

        $http = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.config('typescript-generator.openai_api_key'),
        ])->post(
            'https://api.openai.com/v1/chat/completions',
            [
                'model' => 'gpt-3.5-turbo',
                'messages' => [[
                    'role' => 'user',
                    'content' => 'convert json '.json_encode($response->getContent()).' to typescript interface, do not include explanation, do not include examples, just the interface',
                ]],
            ]
        );

        if ($http->successful()) {
            $result = $http->json('choices')[0]['message']['content'];
            File::put($filename, $result);
        }

        return $response;
    }
}
