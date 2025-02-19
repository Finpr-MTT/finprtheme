(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Function to update MT version selection
        function updateMTVersion() {
            var selected_platform = $('input[name="yourpropfirm_mt_version"]:checked').val();
            
            // Send AJAX request to update session
            $.ajax({
                type: 'POST',
                url: wc_checkout_params.ajax_url,
                data: {
                    action: 'update_mt_version',
                    platform: selected_platform
                },
                success: function() {
                    // Trigger cart update
                    $('body').trigger('update_checkout');
                }
            });
        }

        // Listen for radio button changes
        $(document).on('change', 'input[name="yourpropfirm_mt_version"]', function() {
            updateMTVersion();
        });
        
        // Run on page load to handle default selection
        updateMTVersion();
    });
    
})(jQuery);