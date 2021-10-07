module.exports = {
    extends: ["eslint:recommended", "plugin:vue/strongly-recommended"],
    rules: {
        // https://eslint.vuejs.org/
        "vue/max-attributes-per-line": [
            "warn",
            {
                singleline: 3,
                multiline: {
                    max: 1,
                    allowFirstLine: true
                }
            }
        ],
        "vue/html-closing-bracket-newline": "off",
        "vue/singleline-html-element-content-newline": "off",
        "vue/html-closing-bracket-spacing": "off",
        "vue/custom-event-name-casing": "warn",
        quotes: ["warn", "single"],
        "no-unused-vars": [
            "warn",
            {
                vars: "all",
                args: "none",
                ignoreRestSiblings: false
            }
        ]
    },
    globals: {
        Vue: true
    },
    env: {
        es6: true,
        browser: true,
        node: true
    },
    ignorePatterns: ["public/", "node_modules/", "vendor/"]
};
