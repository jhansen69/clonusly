<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<h2>Welcome to the playground page</h2>


<input type="text" class="form-control" id="keywordSearch" 
    data-server="/api/keywords/search" 
    data-live-server="true" 
    placeholder="Type something" />


<form>
  <input id="rtEditor" type="text" name="content" onChange="console.log('change');" value="Editor content goes here" >
  <trix-editor id='trixEditor' input="rtEditor"></trix-editor>
</form>
  <h4>outputting trix</h4>
  <div id="trixContent" class="trix-content"></div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const rtEditor = document.getElementById('rtEditor');
        const trixEditor = document.getElementById('trixEditor');
        const trixDisplay = document.getElementById('trixContent');
        trixEditor.addEventListener('trix-change',()=>{
            console.log("input happened");
            trixDisplay.innerHTML=rtEditor.value;
        })
    })
</script>

<script type='module'>
    import Autocomplete from "/assets/js/autocomplete.js";
    document.addEventListener("DOMContentLoaded", function () {
        const keywordField = document.getElementById('keywordSearch');
        const opts = {
            onSelectItem: function (item, inst) {
            // item contains the details of the selected item
            //console.log(item); // Log the selected item object
            //console.log(inst);  // Log the autocomplete instance
            
            // Assuming item contains 'id' and 'label' properties
            const selectedId = item.value;  // Use item.value for the selected id
            const selectedKeyword = item.label; // Use item.label for the selected keyword
            
            // Now you can use selectedId and selectedKeyword as needed
            console.log(`Selected ID: ${selectedId}, Keyword: ${selectedKeyword}`);
            
            // You can pass selectedId to another function or use it elsewhere
            // e.g., updating another element based on the selection
            useSelectedId(selectedId);
            },
            suggestionsThreshold: 2,
            fullWidth:true,
            debounceTime: 3
        };
        new Autocomplete(keywordField, opts);

        // Example function that does something with the selectedId
            function useSelectedId(selectedId) {
                // You can perform any action you need with the selected ID here
                console.log(`Using selected ID: ${selectedId}`);
                // For example, you might want to update a hidden input field or make another API request
            }

        
    });
</script>

<?php require base_path('views/partials/footer.php') ?>
