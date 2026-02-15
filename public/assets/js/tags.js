// Basic Tags
const basicInput = document.getElementById("basicTags");
new Tagify(basicInput);

// Predefined Tags
const predefinedInput = document.getElementById("predefinedTags");
new Tagify(predefinedInput);

// Max Tags
const maxTagsInput = document.getElementById("maxTags");
const maxTagsCounter = document.getElementById("tagCounter");
const maxTagify = new Tagify(maxTagsInput, {
    maxTags: 5,
    callbacks: {
        add: updateCounter,
        remove: updateCounter,
    },
});

function updateCounter() {
    const count = maxTagify.value.length;
    maxTagsCounter.textContent = `${count} / 5 tags`;
}

// Email Tags
const emailInput = document.getElementById("emailTags");
new Tagify(emailInput, {
    pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    delimiters: ",| ",
    placeholder: "Enter email addresses",
});

// Color Tags
const colorInput = document.getElementById("colorTags");
const colorWhitelist = [
    { value: "Red", color: "red" },
    { value: "Blue", color: "blue" },
    { value: "Green", color: "green" },
    { value: "Yellow", color: "yellow" },
    { value: "Purple", color: "purple" },
    { value: "Pink", color: "pink" },
];
new Tagify(colorInput, {
    whitelist: colorWhitelist,
    dropdown: {
        enabled: 1,
    },
    templates: {
        tag: function (tagData) {
            return `<tag title='${tagData.value}' contenteditable='false' spellcheck="false" 
                            class='tagify__tag tagify--color-${tagData.color || ""}'>
                            <x title='remove tag' class='tagify__tag__removeBtn'></x>
                            <div><span class='tagify__tag-text'>${tagData.value}</span></div>
                        </tag>`;
        },
    },
});

// Autocomplete Tags
const autocompleteInput = document.getElementById("autocompleteTags");
const languagesList = [
    "JavaScript",
    "Python",
    "Java",
    "C++",
    "C#",
    "PHP",
    "Ruby",
    "Go",
    "Swift",
    "Kotlin",
    "TypeScript",
    "Rust",
    "Scala",
    "R",
    "Perl",
];
new Tagify(autocompleteInput, {
    whitelist: languagesList,
    dropdown: {
        maxItems: 20,
        classname: "tags-look",
        enabled: 0,
        closeOnSelect: false,
    },
});

// Country Tags
const countryInput = document.getElementById("countryTags");
const countriesList = [
    "United States",
    "United Kingdom",
    "Canada",
    "Australia",
    "Germany",
    "France",
    "Spain",
    "Italy",
    "Japan",
    "China",
    "India",
    "Brazil",
];
new Tagify(countryInput, {
    whitelist: countriesList,
    dropdown: {
        enabled: 0,
        maxItems: 10,
    },
});

// Unique Tags
const uniqueInput = document.getElementById("uniqueTags");
new Tagify(uniqueInput, {
    duplicates: false,
});

// Read Only Tags
const readonlyInput = document.getElementById("readonlyTags");
new Tagify(readonlyInput, {
    editTags: false,
});

// Blog Post Tags
const postTagsInput = document.getElementById("postTags");
const blogTopics = [
    "Tutorial",
    "Guide",
    "Tips",
    "News",
    "Review",
    "Comparison",
    "How-to",
    "Best Practices",
    "Case Study",
    "Interview",
];
new Tagify(postTagsInput, {
    whitelist: blogTopics,
    dropdown: {
        enabled: 1,
    },
});

// SEO Tags
const seoTagsInput = document.getElementById("seoTags");
new Tagify(seoTagsInput, {
    maxTags: 10,
});

// Related Tags
const relatedTagsInput = document.getElementById("relatedTags");
new Tagify(relatedTagsInput);

// Product Categories
const productCategoriesInput = document.getElementById("productCategories");
const categories = [
    "Electronics",
    "Clothing",
    "Books",
    "Home & Garden",
    "Sports",
    "Toys",
    "Beauty",
    "Automotive",
    "Food",
    "Health",
];
new Tagify(productCategoriesInput, {
    whitelist: categories,
    dropdown: {
        enabled: 1,
    },
});

// Product Features
const productFeaturesInput = document.getElementById("productFeatures");
new Tagify(productFeaturesInput);

// Search Tags
const searchTagsInput = document.getElementById("searchTags");
new Tagify(searchTagsInput, {
    maxTags: 15,
});
