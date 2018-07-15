{$expand_all = $expand_all|default:false}

<table class="table table-tree table-middle">
    <thead>
    <tr>
        <th width="1%">{include file="common/check_items.tpl"}</th>
        <th width="99%">
            <div class="pull-left">
                <span alt="{__("expand_collapse_list")}" title="{__("expand_collapse_list")}" id="on_variations_tree" class="cm-combinations{if $expand_all} hidden{/if}"><span class="icon-caret-right"> </span></span>
                <span alt="{__("expand_collapse_list")}" title="{__("expand_collapse_list")}" id="off_variations_tree" class="cm-combinations{if !$expand_all} hidden{/if}"><span class="icon-caret-down"> </span></span>
            </div>
            &nbsp;{__("product_variations.variations")}
        </th>
    </tr>
    </thead>
</table>
<div class="variations_tree">
    {$variant_id = false}
    {$groups = []}

    {foreach from=$combinations item="combination" key="variation_code"}
        {$first_variant_id = $combination.selected_options|reset}

        {if $variant_id !== $first_variant_id}
            {$variant_id = $first_variant_id}
            {$groups.$variant_id.disable = true}
        {/if}
        {if !$combination.exists}
            {$groups.$variant_id.disable = false}
        {/if}
        
        {$groups.$variant_id.items.$variation_code = $combination}
    {/foreach}

    {foreach from=$groups item="group" key="group_id"}
        {$first_combination = $group.items|reset}
        {$first_variant = $first_combination.variants|reset}

        <table class="table table-tree table-middle">
            <tr class="multiple-table-row cm-row-status-{if $group.disable}d{else}a{/if}">
                {math equation="x*14" x=0 assign="shift"}
                <td width="1%">
                    <input type="checkbox" name="variation_codes[]" value="" data-ca-target="group_{$group_id}" class="cm-check-items cm-item cm-item-status-d" {if $group.disable} checked disabled{/if} />
                </td>
                <td width="99%">
                    {strip}
                        <span style="padding-left: {$shift}px;">
                            <span alt="{__("expand_sublist_of_items")}" title="{__("expand_sublist_of_items")}" id="on_group_{$group_id}" class="cm-combination {if $expand_all}hidden{/if}" ><span class="icon-caret-right"> </span></span>
                            <span alt="{__("collapse_sublist_of_items")}" title="{__("collapse_sublist_of_items")}" id="off_group_{$group_id}" class="cm-combination{if !$expand_all} hidden{/if}" ><span class="icon-caret-down"> </span></span>
                            <span class="row-status">{$first_variant.option_name}: {$first_variant.variant_name}</span>
                        </span>
                    {/strip}
                </td>
            </tr>
        </table>
        <div id="group_{$group_id}" {if !$expand_all}class="hidden"{/if}>
            <table class="table table-tree table-middle">
                {foreach from=$group.items item="item" key="variation_code"}
                    {include file="addons/product_variations/views/product_variations/components/variations_list_row.tpl"
                        level=1
                        combination=$item
                        variation_code=$variation_code
                        group_meta="group_`$group_id`"
                    }
                {/foreach}
            </table>
        </div>
    {/foreach}

</div>
