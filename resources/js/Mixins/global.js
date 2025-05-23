// Mixins/global.js
export default {
    // cache the value
    computed: {
        // langsung ambil seluruh page context
        page() {
            return this.$page;
        },
        // shortcut ke shared auth
        auth() {
            return this.page.props.auth;
        },
    },

    // not cached and update every render
    methods: {
        can(permissions) {
            return permissions.some((perm) => this.$page.props.can?.[perm]);
        },
        lang() {
            return this.$page.props.app.language.original;
        },
        num(value) {
            return new Intl.NumberFormat("id-ID").format(value);
        },
    },
};
