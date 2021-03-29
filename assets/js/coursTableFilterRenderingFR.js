var filtersConfig = {
    // instruct TableFilter location to import ressources from
    base_path: 'assets/tablefilter/',
    paging: {
        results_per_page: [' Cours par page: ', [10, 25, 50, 100]]
    },
    help_instructions: false,
    col_2: 'select',
    col_3: 'select',
    col_4: 'select',
    col_5: 'select',
    col_7: 'select',
    col_8: 'select',
    col_9: 'none',
    col_10: 'none',
    clear_filter_text: 'Vide',
    auto_filter: {},
    alternate_rows: true,
    rows_counter: {
        text: 'Nombre de cours : '
    },
    btn_reset: {
        tooltip: 'Effacer les filtres',
        toolbar_position: 'right'
    },
    loader: true,
    mark_active_columns: true,
    highlight_keywords: true,
    no_results_message: {
        content: "<div class='alert alert-danger'>\n\
                                       <p>Aucun résultat dans CCES</p>\n\
                                       <p>Consultez <a>https://www.univ-tours.fr/formations/offre-de-formation</a></p>\n\
                                       <p>Contactez Frédéric Soreau : incoming.mobility@univ-tours.fr</p>\n\
                                    </div>"
    },
    extensions: [{
        name: 'sort',
        types: ['string', 'string', 'string', 'string', 'numeric', 'numeric', 'none', 'none']
    }]
};
var tf = new TableFilter('courseTable', filtersConfig);
tf.init();