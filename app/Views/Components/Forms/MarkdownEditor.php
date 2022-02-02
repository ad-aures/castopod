<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class MarkdownEditor extends FormComponent
{
    /**
     * @var string[]
     */
    protected array $disallowList = [];

    public function setDisallowList(string $value): void
    {
        $this->disallowList = explode(',', $value);
    }

    public function render(): string
    {
        $editorClass = 'w-full flex flex-col bg-elevated border-3 border-contrast rounded-lg overflow-hidden focus-within:ring-accent ' . $this->class;

        $this->attributes['class'] = 'bg-elevated border-none focus:border-none focus:outline-none focus:ring-0 w-full h-full';
        $this->attributes['rows'] = 6;

        $value = htmlspecialchars_decode($this->value);

        $oldValue = old($this->name);
        if ($oldValue === null) {
            $oldValue = $value;
        }
        $textarea = form_textarea($this->attributes, $oldValue);
        $markdownIcon = icon(
            'markdown',
            'mr-1 text-lg opacity-40'
        );
        $translations = [
            'write' => lang('Common.forms.editor.write'),
            'preview' => lang('Common.forms.editor.preview'),
            'help' => lang('Common.forms.editor.help'),
        ];

        $toolbarGroups = [
            [
                [
                    'name' => 'header',
                    'tag' => 'md-header',
                    'icon' => icon('heading'),
                ],
                [
                    'name' => 'bold',
                    'tag' => 'md-bold',
                    'icon' => icon('bold'),
                ],
                [
                    'name' => 'italic',
                    'tag' => 'md-italic',
                    'icon' => icon('italic'),
                ],
            ],
            [
                [
                    'name' => 'unordered-list',
                    'tag' => 'md-unordered-list',
                    'icon' => icon('list-unordered'),
                ],
                [
                    'name' => 'ordered-list',
                    'tag' => 'md-ordered-list ',
                    'icon' => icon('list-ordered'),
                ],
            ],
            [
                [
                    'name' => 'quote',
                    'tag' => 'md-quote',
                    'icon' => icon('quote'),
                ],
                [
                    'name' => 'link',
                    'tag' => 'md-link',
                    'icon' => icon('link'),
                ],
                [
                    'name' => 'image',
                    'tag' => 'md-image',
                    'icon' => icon('image-add'),
                ],
            ],
        ];

        $toolbarContent = '';
        foreach ($toolbarGroups as $buttonsGroup) {
            $toolbarContent .= '<div class="inline-flex text-2xl gap-x-1">';
            foreach ($buttonsGroup as $button) {
                if (! in_array($button['name'], $this->disallowList, true)) {
                    $toolbarContent .= '<' . $button['tag'] . ' class="opacity-50 hover:opacity-100 focus:ring-accent focus:opacity-100">' . $button['icon'] . '</' . $button['tag'] . '>';
                }
            }
            $toolbarContent .= '</div>';
        }

        return <<<HTML
            <div class="{$editorClass}">
                <header class="px-2">
                    <div class="sticky top-0 z-20 flex flex-wrap justify-between border-b border-gray-300 bg-elevated">
                        <markdown-write-preview for="{$this->id}" class="relative inline-flex h-8">
                            <button type="button" slot="write" class="px-2 font-semibold focus:ring-inset focus:ring-accent">{$translations['write']}</button>
                            <button type="button" slot="preview" class="px-2 font-semibold focus:ring-inset focus:ring-accent">{$translations['preview']}</button>
                        </markdown-write-preview>
                        <markdown-toolbar for="{$this->id}" class="flex gap-4 px-2 py-1">{$toolbarContent}</markdown-toolbar>
                    </div>
                </header>
                <div class="relative">
                    {$textarea}
                    <markdown-preview for="{$this->id}" class="absolute top-0 left-0 hidden w-full h-full max-w-full px-3 py-2 overflow-y-auto prose bg-base" showClass="bg-elevated" />
                </div>
                <footer class="flex px-2 py-1 border-t bg-base">
                    <a href="https://commonmark.org/help/" class="inline-flex items-center text-xs font-semibold text-skin-muted hover:text-skin-base" target="_blank" rel="noopener noreferrer">{$markdownIcon}{$translations['help']}</a>
                </footer>
            </div>
        HTML;
    }
}
