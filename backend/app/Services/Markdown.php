<?php
namespace App\Services;

use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
// 追加
use League\CommonMark\Extension\DisallowedRawHTML\DisallowedRawHTMLExtension;

class Markdown
{
    public static function parse($text)
    {
        $environment = Environment::createCommonMarkEnvironment();

        $environment->addExtension(new TableExtension);
        // 追加
        $environment->addExtension(new DisallowedRawHTMLExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());

        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
        ], $environment);


        return new HtmlString($converter->convertToHtml($text));
    }
}
?>