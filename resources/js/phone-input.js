document.addEventListener('livewire:init', function () {

    function initPhoneInput(input) {

        if (!input || input.dataset.itiInitialized) {
            return;
        }

        input.dataset.itiInitialized = 'true';

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
                "https://cdn.jsdelivr.net/npm/intl-tel-input@28.1.0/dist/js/utils.js"

        });

        function updatePhoneData() {

            const countryData = iti.getSelectedCountryData();

            const componentElement = input.closest('[wire\\:id]');

            if (!componentElement) {
                return;
            }

            const component = Livewire.find(componentElement.getAttribute('wire:id'));

            if (!component) {
                return;
            }

            component.set('phone_country_code', '+' + countryData.dialCode);
            component.set('phone_number', input.value);

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

    }

    Livewire.hook('element.init', ({ el }) => {

        if (el.matches && el.matches('#phone')) {
            initPhoneInput(el);
        }

    });

});
