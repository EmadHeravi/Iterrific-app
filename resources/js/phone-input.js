document.addEventListener('livewire:load', function () {

    const input = document.querySelector("#phone");

    if (!input) {
        return;
    }

    const iti = window.intlTelInput(input, {

        initialCountry: "nl",

        separateDialCode: true,

        preferredCountries: [
            "nl",
            "be",
            "de",
            "fr",
            "gb"
        ],

        utilsScript:
            "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"

    });

    function updatePhoneData() {

        const countryData = iti.getSelectedCountryData();

        Livewire.find(
            input.closest('[wire\\:id]').getAttribute('wire:id')
        ).set(
            'phone_country_code',
            '+' + countryData.dialCode
        );

        Livewire.find(
            input.closest('[wire\\:id]').getAttribute('wire:id')
        ).set(
            'phone_number',
            input.value
        );

    }

    input.addEventListener(
        'countrychange',
        updatePhoneData
    );

    input.addEventListener(
        'input',
        updatePhoneData
    );

    updatePhoneData();

});