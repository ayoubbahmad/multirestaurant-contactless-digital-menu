<script>
    // ----------------- Store toggle js handler start ------------------------- //
    function triggerStorePower(store,store_id){
        var url = "{{route('toggle_store_power',['id'=> 'xx_id' ])}}";
        var url = url.replace('xx_id', store_id);
        var toggle_id = "power-toggle-" + store_id
        document.getElementById(toggle_id).disabled = true;
        fetch(url, {
            method: 'POST',
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": "{{csrf_token()}}"
            },
            body: JSON.stringify({is_visible: store.value == 0 ? 1: 0})
        })
            .then(function(response) {
                return response.json();
            })
            .then(function(result) {
                if(result.success){
                    document.getElementById(toggle_id).value = store.value == 0 ? 1: 0

                }else{
                    document.getElementById(toggle_id).value = store.value
                }
                document.getElementById(toggle_id).disabled = false;

            })
            .catch(function(error) {
                console.log("err");
                console.error('Error:', error);
                document.getElementById(toggle_id).disabled = false;
            });

    }

    // ----------------- Store toggle js handler end ------------------------- //

</script>
