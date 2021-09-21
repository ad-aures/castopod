<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class MarkdownEditor extends FormComponent
{
    public function render(): string
    {
        $editorClass = 'w-full flex flex-col bg-white border-3 border-black rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-offset-2 focus-withing:ring-offset-pine-100 focus-within:ring-pine-500 ' . $this->class;

        $this->attributes['class'] = 'border-none outline-none focus:border-none focus:outline-none focus:ring-0 w-full h-full';
        $this->attributes['rows'] = 6;

        $textarea = form_textarea($this->attributes, old($this->name, $this->value, false));
        $icons = [
            'heading' => icon('heading'),
            'bold' => icon('bold'),
            'italic' => icon('italic'),
            'list-unordered' => icon('list-unordered'),
            'list-ordered' => icon('list-ordered'),
            'quote' => icon('quote'),
            'link' => icon('link'),
            'image-add' => icon('image-add'),
            'markdown' => icon(
                'markdown',
                'mr-1 text-lg text-gray-400'
            ),
        ];
        $translations = [
            'write' => lang('Common.forms.editor.write'),
            'preview' => lang('Common.forms.editor.preview'),
            'help' => lang('Common.forms.editor.help'),
        ];

        return <<<HTML
            <div class="{$editorClass}">
                <header class="px-2">
                    <div class="sticky top-0 z-20 flex flex-wrap justify-between bg-white border-b border-gray-300">
                        <markdown-write-preview for="{$this->id}" class="relative inline-flex h-8">
                            <button type="button" slot="write" class="px-2 font-semibold focus:outline-none focus:ring-inset focus:ring-2 focus:ring-pine-600">{$translations['write']}</button>
                            <button type="button" slot="preview" class="px-2 font-semibold focus:outline-none focus:ring-inset focus:ring-2 focus:ring-pine-600">{$translations['preview']}</button>
                        </markdown-write-preview>
                        <markdown-toolbar for="{$this->id}" class="flex gap-4 px-2 py-1">
                            <div class="inline-flex text-2xl gap-x-1">
                                <md-header class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">{$icons['heading']}</md-header>
                                <md-bold class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">{$icons['bold']}</md-bold>
                                <md-italic class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">{$icons['italic']}</md-italic>
                            </div>
                            <div class="inline-flex text-2xl gap-x-1">
                                <md-unordered-list class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">{$icons['list-unordered']}</md-unordered-list>
                                <md-ordered-list class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">{$icons['list-ordered']}</md-ordered-list>
                            </div>
                            <div class="inline-flex text-2xl gap-x-1">
                                <md-quote class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">{$icons['quote']}</md-quote>
                                <md-link class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">{$icons['link']}</md-link>
                                <md-image class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">{$icons['image-add']}</md-image>
                            </div>
                        </markdown-toolbar>
                    </div>
                </header>
                <div class="relative">
                    {$textarea}
                    <markdown-preview for="{$this->id}" class="absolute top-0 left-0 hidden w-full h-full p-2 overflow-y-auto prose bg-gray-50" showClass="bg-white" />
                </div>
                <footer class="flex px-2 py-1 bg-gray-100 border-t">
                    <a href="https://commonmark.org/help/" class="inline-flex items-center text-xs font-semibold text-gray-500 hover:text-gray-700" target="_blank" rel="noopener noreferrer">{$icons['markdown']}{$translations['help']}</a>
                </footer>
            </div>
        HTML;
    }
}
