(function($) {
    'use strict';

    $(document).ready(function() {
        function updateStep(step) {
            $('.checkout-step-content').removeClass('active');
            $('.step-' + step).addClass('active');

            $('.checkout-steps .nav-link').removeClass('active');
            $('.checkout-steps .nav-link[data-step="' + step + '"]').addClass('active');
        }

        $('.checkout-steps .nav-link').on('click', function(e) {
            e.preventDefault();
            var step = $(this).data('step');
            updateStep(step);
        });

        $('.next-step').on('click', function() {
            let nextStep = $(this).data('next');
            updateStep(nextStep);
        });

        $('.prev-step').on('click', function() {
            let prevStep = $(this).data('prev');
            updateStep(prevStep);
        });
    });
    
})(jQuery);
