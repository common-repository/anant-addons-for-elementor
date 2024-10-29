(function ($) {
	'use strict';
  function formatState(state) {
    if (!state.id) {
        return state.text;
    }
    var $state = $(
        '<span>' + state.text + '</span>' 
        );
    return $state;
  }; 

  $(document).ready(function() {
    jQuery(".ant-wishlist-temp-select").each(function() { 
      var _this = jQuery(this);
      var jQuerypl = _this.attr("data-placeholder");
      _this.select2({
          dropdownParent: _this.closest("div"), 
          placeholder: jQuerypl, 
          minimumResultsForSearch: Infinity, 
          allowClear: true, 
          templateSelection: formatState,
          theme: "classic" 
      });
    }).on('select2:opening select2:closing', function(event) {
      var $searchfield = jQuery(this).parent().find('.select2-search__field');
      $searchfield.prop('disabled', true);
    }); 
  });

} )( jQuery );
// Define variables
const tabs = document.querySelectorAll('[data-tab]');
const content = document.getElementsByClassName('active');

// Activate current tab
const toggleContent = function() {
  if (!this.classList.contains("active")) {
    Array.from(content).forEach(item => {
      item.classList.remove('active');
    });
    this.classList.add('active');
    let currentTab = this.getAttribute('data-tab');
    let tabContent = document.getElementById(currentTab);
    tabContent.classList.add('active');
    
    // Store current tab in local storage
    localStorage.setItem('currentTab', currentTab);
  }
};

// Retrieve current tab from local storage on page load
document.addEventListener('DOMContentLoaded', () => {
  let currentTab = localStorage.getItem('currentTab');
  if (currentTab) {
    let tab = document.querySelector(`[data-tab="${currentTab}"]`);
    if (tab) {
      tab.click();
    }
  }
});

// clear local storage for tabs
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('toplevel_page_anant_admin_menu').addEventListener('click', function(e) {
      localStorage.clear();
      location.reload();
    });
}); 

// Apply event listeners
Array.from(tabs).forEach(item => {
  item.addEventListener('click', toggleContent);
});

// filter tab for tab two
(() => {
  const buttons = document.querySelectorAll("#tab2 .btn");
  const items = document.querySelectorAll("#tab2 .anant-admin-widget");

  buttons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      var filter = e.target.dataset.filter;
      items.forEach((item) => {
        if (filter === "all") {
          item.style.display = "flex";
        } else {
          if (item.classList.contains(filter)) {
            item.style.display = "flex";
          } else {
            item.style.display = "none";
          }
        }
      });
    });
  });
})();

// filter tab for tab three
(() => {
  const buttonsTabs = document.querySelectorAll("#tab3 .btn");
  const itemsTabs = document.querySelectorAll("#tab3 .anant-admin-widget");

  buttonsTabs.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      var filter = e.target.dataset.filter;
      itemsTabs.forEach((item) => {
        if (filter === "all") {
          item.style.display = "flex";
        } else {
          if (item.classList.contains(filter)) {
            item.style.display = "flex";
          } else {
            item.style.display = "none";
          }
        }
      });
    });
  });
})();

// search box for tab two
(() => {
  const searchBoxTab2 = document.querySelector("#tab2 .search");
  const itemsTab2 = document.querySelectorAll("#tab2 .anant-admin-widget, #tab2 .heading, .ant-wishlist-temp-select-main");
  searchBoxTab2.addEventListener("keyup", (e) => {
    const searchFilter = e.target.value;
    var pat = new RegExp(searchFilter, 'i');
    itemsTab2.forEach((item) => {
      if (pat.test(item.innerText)) {
        item.style.display = "flex";
      } else {
        item.style.display = "none";
      }
    });
  });

})();

// search box for tab three
(() => {
  const searchBoxTab3 = document.querySelector("#tab3 .search");
  const itemsTab3 = document.querySelectorAll("#tab3 .ant-admin-widget, #tab3 .heading");
  searchBoxTab3.addEventListener("keyup", (e) => {
    const searchFilter = e.target.value;
    var pat = new RegExp(searchFilter, 'i');
    itemsTab3.forEach((item) => {
      if (pat.test(item.innerText)) {
        item.style.display = "flex";
      } else {
        item.style.display = "none";
      }
    });
  });
})();

// (() => {
//   document.querySelector("#tab2 p.submit").classList.add("text-center");
//   document.querySelector("#tab2 p.text-center").classList.remove("submit");
//   document.querySelector("#tab2 p.text-center > .submit").classList.remove("button");
//   document.querySelector("#tab3 p.submit").classList.add("text-center");
//   document.querySelector("#tab3 p.text-center").classList.remove("submit");
//   document.querySelector("#tab3 p.text-center > .submit").classList.remove("button");
// })();