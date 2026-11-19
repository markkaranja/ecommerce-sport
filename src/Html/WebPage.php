<?php

declare(strict_types=1);

namespace Html;

/**
 * Page web construite morceau par morceau, puis produite en HTML avec toHTML().
 */
class WebPage
{
    private string $head = '';
    private string $title;
    private string $body = '';

    /**
     * @param string $title Titre de la page (onglet du navigateur)
     */
    public function __construct(string $title = '')
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Ajouter du contenu dans la balise head.
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Ajouter une feuille de style externe.
     */
    public function appendCssUrl(string $url): void
    {
        $this->head .= "<link href=\"{$url}\" rel=\"stylesheet\">";
    }

    /**
     * Ajouter un script JavaScript externe.
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= "<script src=\"{$url}\" defer></script>";
    }

    /**
     * Ajouter du contenu dans la balise body.
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * Produire le code HTML complet de la page.
     */
    public function toHTML(): string
    {
        $escapedTitle = $this->escapeString($this->getTitle());

        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>{$escapedTitle}</title>
                {$this->getHead()}
            </head>
            <body>
                {$this->getBody()}
            </body>
        </html>
        HTML;
    }

    /**
     * Protéger un texte avant de l'afficher dans le HTML (contre le XSS).
     */
    public function escapeString(?string $string): string
    {
        if ($string === null) {
            return '';
        }

        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}
