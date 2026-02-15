
    // Basic Select2
    $("#basicSelect").select2({
        placeholder: "Select a country",
        allowClear: true,
    });

    // With Placeholder
    $("#placeholderSelect").select2({
        placeholder: "Choose a category",
        allowClear: true,
    });

    // Multiple Select
    $("#multipleSelect").select2({
        placeholder: "Select programming languages",
        allowClear: true,
    });

    // Searchable with Groups
    $("#searchSelect").select2({
        placeholder: "Search countries",
        allowClear: true,
    });

    // Max Selection
    $("#maxSelect").select2({
        placeholder: "Select up to 3 colors",
        maximumSelectionLength: 3,
    });

    // Tags Mode
    $("#tagsSelect").select2({
        tags: true,
        placeholder: "Add or create tags",
        tokenSeparators: [",", " "],
    });

    // Disabled Options
    $("#disabledSelect").select2({
        placeholder: "Select an option",
        allowClear: true,
    });

    // Clear Selection
    $("#clearSelect").select2({
        placeholder: "Select an option",
        allowClear: true,
    });

    // Template with Icons
    $("#templateSelect").select2({
        placeholder: "Select a user",
        allowClear: true,
        templateResult: formatUser,
        templateSelection: formatUser,
    });

    function formatUser(user) {
        if (!user.id) return user.text;
        var $user = $(
            '<span><i class="bi ' +
                $(user.element).data("icon") +
                ' me-2"></i>' +
                user.text +
                "</span>",
        );
        return $user;
    }

    // Form Selects
    $("#countrySelect").select2({
        placeholder: "Select your country",
        allowClear: true,
    });

    $("#languageSelect").select2({
        placeholder: "Select your language",
        allowClear: true,
    });

    $("#skillsSelect").select2({
        placeholder: "Select your skills",
        allowClear: true,
    });

    $("#interestsSelect").select2({
        tags: true,
        placeholder: "Add your interests",
        allowClear: true,
    });

