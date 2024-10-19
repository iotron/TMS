<div>
    <!-- An unexamined life is not worth living. - Socrates -->
</div>

<style>

    /*Grid Start*/

    .filament-tiptap-grid,
    .filament-tiptap-grid-builder {
        display: grid;
        gap: 1rem;
        box-sizing: border-box;

        .filament-tiptap-grid__column,
        .filament-tiptap-grid-builder__column {
            box-sizing: border-box;
            border-style: dashed;
            border-width: 1px;
            border-color: #9ca3af;      {{-- old value theme("colors.gray.400") --}}
            padding: 0.5rem;
            /*border-radius: theme("borderRadius.DEFAULT");*/
            border-radius: .25rem; /* Default radius is .375rem, but here it is set to .25rem */

            > * + * {
                margin-block-start: 1rem;
            }
        }

        &.ProseMirror-selectednode {
            /*border-radius: theme("borderRadius.DEFAULT");*/
            border-radius: .25rem; /* Default radius is .375rem, but here it is set to .25rem */
            outline-offset: 2px;
            outline: #111827 dashed 2px;    {{-- old value theme("colors.gray.900") --}}
        }
    }

    .filament-tiptap-grid[type^="asymetric"] {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
    }

    @media (max-width: 640px) {
        /* This corresponds to theme('screens.sm') */
    .filament-tiptap-grid-builder[data-stack-at="sm"] {
            grid-template-columns: 1fr !important;

            .filament-tiptap-grid-builder__column {
                grid-column: span 1 !important;
            }
        }
    }

    @media (max-width: 768px) {
        /* This corresponds to theme('screens.md') */
        .filament-tiptap-grid-builder[data-stack-at="md"] {
            grid-template-columns: 1fr !important;

            .filament-tiptap-grid-builder__column {
                grid-column: span 1 !important;
            }
        }
    }

    @media (max-width: 1024px) {
        /* This corresponds to theme('screens.lg') */
        .filament-tiptap-grid-builder[data-stack-at="lg"] {
                grid-template-columns: 1fr !important;

                .filament-tiptap-grid-builder__column {
                    grid-column: span 1 !important;
                }
            }
        }

    .filament-tiptap-grid[type="asymetric-right-thirds"] {
        @screen md {
            grid-template-columns: 1fr 2fr;
        }
    }

    .filament-tiptap-grid[type="asymetric-left-thirds"] {
        @screen md {
            grid-template-columns: 2fr 1fr;
        }
    }

    .filament-tiptap-grid[type="asymetric-right-fourths"] {
        @screen md {
            grid-template-columns: 1fr 3fr;
        }
    }

    .filament-tiptap-grid[type="asymetric-left-fourths"] {
        @screen md {
            grid-template-columns: 3fr 1fr;
        }
    }

    .filament-tiptap-grid[type="responsive"] {
        grid-template-columns: 1fr;
        grid-template-rows: auto;

        &[cols="2"] {
            @screen md {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        &[cols="3"] {
            @screen md {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        &[cols="4"] {
            @screen md {
                grid-template-columns: repeat(2, 1fr);
            }

            @screen lg {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        &[cols="5"] {
            @screen md {
                grid-template-columns: repeat(5, 1fr);
            }
        }
    }

    .filament-tiptap-grid[type="fixed"] {
        &[cols="2"] {
            grid-template-columns: repeat(2, 1fr);
        }

        &[cols="3"] {
            grid-template-columns: repeat(3, 1fr);
        }

        &[cols="4"] {
            grid-template-columns: repeat(4, 1fr);
        }

        &[cols="5"] {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    /*Dark Mode Grid*/

    .dark {
        .filament-tiptap-grid {
            .filament-tiptap-grid__column {
                border-color: #6b7280;      {{-- old value theme("colors.gray.500") --}}
            }

            &.ProseMirror-selectednode {
                outline-color: #9ca3af;         {{-- old value theme("colors.gray.400") --}}
            }
        }
    }


    /*Grid End*/



    /*Table Start*/

    table {
        border-collapse: collapse;
        margin: 0;
        overflow: hidden;
        table-layout: fixed;
        width: 100%;
        position: relative;
    }

    table td,
    table th {
        border: 1px solid #9ca3af;      {{-- old value theme("colors.gray.400") --}}
        min-width: 1em;
        padding: 3px 5px;
        vertical-align: top;
        background-clip: padding-box
    }

    table td > *,
    table th > * {
        margin-bottom: 0;
    }

    table th {
        background-color: #e5e7eb;      {{-- old value theme("colors.gray.200") --}}
        color: #374151;     {{-- old value theme("colors.gray.700") --}}
        font-weight: 700;
        text-align: left;
    }

    table .selectedCell {
        position: relative;
    }

    table .selectedCell:after {
        background: rgba(200, 200, 255, 0.4);
        content: "";
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        pointer-events: none;
        position: absolute;
        z-index: 2;
    }

    table .column-resize-handle {
        background-color: #adf;
        bottom: -2px;
        position: absolute;
        right: -2px;
        pointer-events: none;
        top: 0;
        width: 4px;
    }

    table p {
        margin: 0;
    }

    .tableWrapper {
        padding: 1rem 0;
        overflow-x: auto;
    }

    /*Dark Mode Table*/
    .dark {
        table td,
        table th {
            border-color: #4b5563;          {{-- old value theme("colors.gray.600") --}}
        }

        table th {
            background-color: #1f2937;      {{-- old value theme("colors.gray.800") --}}
            color: #f3f4f6;                 {{-- old value theme('colors.gray.100') --}}
        }
    }

    /*Table End*/



    /*Code Block Start*/

    pre {
        padding: .75rem 1rem;
        border-radius: .25rem;
        font-size: .875rem;

        code {
            border-radius: 0;
            padding-inline: 0;
        }
    }

    code {
        background-color: #d1d5db;      {{-- old value theme("colors.gray.300") --}}
        border-radius: 0.25rem;
        padding-inline: 0.25rem;
    }

    pre.hljs {
        direction: ltr;
        code {
            background-color: transparent;
        }
    }
    /*Code In Dark Mode*/

    .dark {
        code {
            background-color: #1f2937;  {{-- old value theme("colors.gray.800") --}}
        }
    }

    /*Code Block End*/



    /*Image Css Start*/

    img {
        border: dashed 2px transparent;

        &.ProseMirror-selectednode {
            /*border-radius: theme("borderRadius.DEFAULT");*/
            border-radius: .25rem; /* Default radius is .375rem, but here it is set to .25rem */
            outline-offset: 2px;
            outline: #111827 dashed 2px;        {{-- old value theme("colors.gray.900") --}}
        }
    }

    img {
        display: inline-block;
    }

    /*Dark Mode Image*/

    .dark {
        img.ProseMirror-selectednode {
            outline-color: #9ca3af;     {{-- old value theme("colors.gray.400") --}}
        }
    }



    /*Image Css End*/


    /*Text CSS Start*/
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: bold;
    }

    h1 {
        font-size: 1.75rem;
        line-height: 1.1;
    }

    h2 {
        font-size: 1.5rem;
        line-height: 1.1;
    }

    h3 {
        font-size: 1.25rem;
        line-height: 1.25;
    }

    h4 {
        font-size: 1.125rem;
    }

    .lead {
        font-size: 1.375rem;
        line-height: 1.3;
    }

    small {
        font-size: 0.75rem;
    }
    /*Text Css End*/


    /*Tiptap Editor Specific*/




    /*Tiptap Editor Specific*/





</style>
