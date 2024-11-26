import 'jquery';
import '../select2.js';

    

function formatState (state) {
    if (!state.id) {
      return state.text;
    }
    var baseUrl = elgg.normalize_url('/mod/debates/graphics/sdg');
    var $state = $(
      '<span><img src="' + baseUrl + '/' + state.id + '.png" class="img-flag" width="40"/> ' + state.title + '</span>'
    );
    
    return $state;
  };

    $(document).ready(function() {
        $('.js-goals-single').select2({
            templateResult: formatState,
            templateSelection: formatState,
            width: '49%',
            placeholder: "Select a Sustainable Development Goal",
        });
    });
 