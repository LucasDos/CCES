var filtersConfig = {
    // instruct TableFilter location to import ressources from
    base_path: 'assets/tablefilter/',
    help_instructions: false,
    col_2: 'select',
    col_3: 'select',
    col_4: 'select',
    col_5: 'select',
    col_7: 'select',
    col_8: 'select',
    col_9: 'none',
    col_10: 'none',
    clear_filter_text: 'Empty',
    auto_filter: {},
    alternate_rows: true,
    btn_reset: {
        tooltip: 'Empty filters',
        toolbar_position: 'right'
    },
    loader: true,
    mark_active_columns: true,
    highlight_keywords: true,
    no_results_message: {
        content: "<div class='alert alert-danger'>\n\
                                       <p>No results in CCES</p>\n\
                                       <p>Consult <a>https://www.univ-tours.fr/formations/offre-de-formation</a></p>\n\
                                       <p>Contact Frédéric Soreau : incoming.mobility@univ-tours.fr</p>\n\
                                    </div>"
    },
    extensions: [{
        name: 'sort',
        types: ['string', 'string', 'string', 'string', 'numeric', 'numeric', 'none', 'none']
    }]
};