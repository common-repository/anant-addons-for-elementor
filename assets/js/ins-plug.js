(function ($) {
	'use strict';

	$( 'body' ).on( 'click', '.plug-btn',
		function(e) {
			var $this = $( this );
			var plugs = $( this ).attr("id");
      var nonce = ins_plug_ajax_obj.nonce; // Retrieve nonce value
      var spin = $this.parents('.anant-admin-tabs-area');
      let load_msg = document.createElement("div");
      let spinner = document.createElement("i");
      let msg = document.createElement("p");
			var data     = {
				action: 'install_act_plugin',
				plugs: plugs,
        nonce: nonce, 
			};

			$.ajax(
				{
					type: 'POST',
					url: ins_plug_ajax_obj.ajax_url,
					data: data,
          beforeSend: function (response) {
            msg.innerHTML = "Installing Plugin";
            spinner.style.fontSize = "50px";
            spinner.style.color = "#2649F9";
            spinner.classList.add("fas");
            spinner.classList.add("fa-sync-alt");
            spinner.classList.add("fa-spin");
            load_msg.classList.add("plug-msg");
            load_msg.append(spinner);
            load_msg.append(msg);
            spin.append(load_msg);
					},
					success: function (response) {
						// alert(response);
            document.querySelector('.plug-msg').remove();
            msg.innerHTML = "Done!";
            spinner.className = '';
            spinner.classList.add("fas");
            spinner.classList.add("fa-check");
            load_msg.append(spinner);
            load_msg.append(msg);
            spin.append(load_msg);
            console.log(response);
            setTimeout(function() {
              location.reload();
            }, 1000);
            
					},
					error: function(errorThrown){
            console.log(errorThrown);
						alert('error');
					},
				}
			);
			
		}
	);

  var Radio1 = document.getElementById("radio-1");
  var Radio2 = document.getElementById("radio-2");
  var Radio3 = document.getElementById("radio-3");
  var Radio4 = document.getElementById("radio-4");

  Radio1.addEventListener("change", function() {
    var checked = this.checked;
    var otherCheckboxes = document.querySelectorAll("#tab2 .toggleable");
    [].forEach.call(otherCheckboxes, function(item) {
      item.checked = checked;
    });
  });

  Radio2.addEventListener("change", function() {
    var checked = this.checked;
    var otherCheckboxes = document.querySelectorAll("#tab2 .toggleable");
    [].forEach.call(otherCheckboxes, function(item) {
      item.checked = false;
    });
  });

  Radio3.addEventListener("change", function() {
    var checked = this.checked;
    var otherCheckboxes = document.querySelectorAll("#tab3 .toggleable");
    [].forEach.call(otherCheckboxes, function(item) {
      item.checked = checked;
    });
  });

  Radio4.addEventListener("change", function() {
    var checked = this.checked;
    var otherCheckboxes = document.querySelectorAll("#tab3 .toggleable");
    [].forEach.call(otherCheckboxes, function(item) {
      item.checked = false;
    });
  });
  
  let saveBtn = document.querySelector('#save-set1');
  saveBtn.addEventListener('click', () =>{
      saveBtn.value = 'Saving...';
      saveBtn.style.background = '#000';
  });
  
  let saveBtn2 = document.querySelector('#save-set2');
  saveBtn2.addEventListener('click', () =>{
      saveBtn2.value = 'Saving...';
      saveBtn2.style.background = '#000';
  }); 

} )( jQuery );