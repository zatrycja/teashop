<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    const LIST_LS = "lists";
      let lists = [];

    function loadStorage() {
      const loadStorage = localStorage.getItem(LIST_LS);

      if (!loadStorage) {
        return;
      }

      const parsedList = JSON.parse(loadStorage);
      parsedList.forEach(list => createItem(list.text, list.quantity));
    }
    function saveStorage() {
      localStorage.setItem(LIST_LS, JSON.stringify(lists));
    }

    function createItem(text, quantity) {
      lists.push({ text, quantity});
      saveStorage();
    }

    function deleteItem(text) {
      var i = 0;
      lists.forEach(list => 
      {
        if(list.text == text){
          lists.splice(i, 1);
        }
        i++;
      }
      );
      saveStorage();
    }

    function clearCart(){
      localStorage.clear();
      //window.location = 'cart.php';
    }

    loadStorage();
    <?php
    if(isset($_GET["pid"]))
       echo "deleteItem({$_GET["pid"]});";
    else
        echo "clearCart();";
    ?>
    window.location = 'cart.php';
</script>