<?php

declare(strict_types=1);

namespace Html;

/**
 * Page de l'application : même structure sur toutes les pages
 * (feuille de style, en-tête avec le titre, contenu).
 */
class AppWebPage extends WebPage
{
    public function __construct(string $title = '')
    {
        parent::__construct($title);
        $this->appendCssUrl('css/style.css');
    }

    public function toHTML(): string
    {
        $escapedTitle = $this->escapeString($this->getTitle());

        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>GoatSport - {$escapedTitle}</title>
            {$this->getHead()}
        </head>
        <body>
            <header class="header">
                <h1>{$escapedTitle}</h1>
            </header>
            <main class="content">
                {$this->getBody()}
            </main>
        </body>
        </html>
        HTML;
    }
}
