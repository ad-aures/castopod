<?php

declare(strict_types=1);

namespace App\View\Components\Forms;

use ViewComponents\Component;

class MarkdownEditor extends Component
{
    protected string $content = '';

    public function render(): string
    {
        $editorClass = 'w-full flex flex-col bg-white border border-gray-500 focus-within:ring-1 focus-within:ring-blue-600';
        if ($this->attributes['class'] !== '') {
            $editorClass .= ' ' . $this->attributes['class'];
            unset($this->attributes['class']);
        }

        $this->attributes['class'] = 'border-none outline-none focus:border-none focus:outline-none w-full h-full';

        return '<div class="' . $editorClass . '">' .
            '<header class="sticky top-0 z-20 flex flex-wrap justify-between bg-white border-b border-gray-500">' .
                '<markdown-write-preview for="' . $this->attributes['id'] . '" class="relative inline-flex h-8">' .
                    '<button type="button" slot="write" class="px-2 font-semibold focus:outline-none focus:ring-inset focus:ring-2 focus:ring-pine-600">' . lang(
                        'Common.forms.editor.write'
                    ) . '</button>' .
                    '<button type="button" slot="preview" class="px-2 focus:outline-none focus:ring-inset focus:ring-2 focus:ring-pine-600">' . lang(
                        'Common.forms.editor.preview'
                    ) . '</button>' .
                '</markdown-write-preview>' .
                '<markdown-toolbar for="' . $this->attributes['id'] . '" class="flex gap-4 px-2 py-1">' .
                    '<div class="inline-flex text-2xl gap-x-1">' .
                        '<md-header class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'heading'
                        ) . '</md-header>' .
                        '<md-bold class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'bold'
                        ) . '</md-bold>' .
                        '<md-italic class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'italic'
                        ) . '</md-italic>' .
                    '</div>' .
                    '<div class="inline-flex text-2xl gap-x-1">' .
                        '<md-unordered-list class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'list-unordered'
                        ) . '</md-unordered-list>' .
                        '<md-ordered-list class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'list-ordered'
                        ) . '</md-ordered-list>' .
                    '</div>' .
                    '<div class="inline-flex text-2xl gap-x-1">' .
                        '<md-quote class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'quote'
                        ) . '</md-quote>' .
                        '<md-link class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'link'
                        ) . '</md-link>' .
                        '<md-image class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'image-add'
                        ) . '</md-image>' .
                    '</div>' .
                '</markdown-toolbar>' .
            '</header>' .
            '<div class="relative">' .
                form_textarea($this->attributes, $this->content) .
                '<markdown-preview for="' . $this->attributes['id'] . '" class="absolute top-0 left-0 hidden w-full h-full p-2 overflow-y-auto prose bg-gray-50" showClass="bg-white"></markdown-preview>' .
            '</div>' .
            '<footer class="flex px-2 py-1 bg-gray-100 border-t">' .
                '<a href="https://commonmark.org/help/" class="inline-flex items-center text-xs font-semibold text-gray-500 hover:text-gray-700" target="_blank" rel="noopener noreferrer">' . icon(
                    'markdown',
                    'mr-1 text-lg text-gray-400'
                ) . lang('Common.forms.editor.help') . '</a>' .
            '</footer>' .
        '</div>';
    }
}
