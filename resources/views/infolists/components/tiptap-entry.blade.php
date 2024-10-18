
<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
<div>
    {!! $getState() !!}
</div>


</x-dynamic-component>


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
            border-color: theme("colors.gray.400");
            padding: 0.5rem;
            border-radius: theme("borderRadius.DEFAULT");

            > * + * {
                margin-block-start: 1rem;
            }
        }

        &.ProseMirror-selectednode {
            border-radius: theme("borderRadius.DEFAULT");
            outline-offset: 2px;
            outline: theme("colors.gray.900") dashed 2px;
        }
    }

    .filament-tiptap-grid[type^="asymetric"] {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
    }

    @media (max-width: theme('screens.sm')) {
        .filament-tiptap-grid-builder[data-stack-at="sm"] {
            grid-template-columns: 1fr !important;

            .filament-tiptap-grid-builder__column {
                grid-column: span 1 !important;
            }
        }
    }

    @media (max-width: theme('screens.md')) {
        .filament-tiptap-grid-builder[data-stack-at="md"] {
            grid-template-columns: 1fr !important;

            .filament-tiptap-grid-builder__column {
                grid-column: span 1 !important;
            }
        }
    }

    @media (max-width: theme('screens.lg')) {
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
                border-color: theme("colors.gray.500");
            }

            &.ProseMirror-selectednode {
                outline-color: theme("colors.gray.400");
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
        border: 1px solid theme("colors.gray.400");
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
        background-color: theme("colors.gray.200");
        color: theme("colors.gray.700");
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
            border-color: theme("colors.gray.600");
        }

        table th {
            background-color: theme("colors.gray.800");
            color: theme('colors.gray.100');
        }
    }

    /*Table End*/








</style>
