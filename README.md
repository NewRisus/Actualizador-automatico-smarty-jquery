# Herramienta para actualizar Smarty y jQuery [Beta]

Ya esta disponible, en todo caso de que les cause error por favor especifique bien el problema.

Actualizador:
 * Smarty 3.1.36
 * Smarty 3.1.37
 * Smarty 3.1.39
 * jQuery 3.5.1
---
> **Nota:** Antes de continuar, crea un backup por si llega a generar algún tipo de problema, a continuación te mencionaré los archivos y carpetas que debes tener en cuenta.

Archivos para el backup:
* **header.php**
* **footer.php**
* inc/class/**c.smarty.php**
* inc/php/**ajax_files.php**
* inc/php/ajax/**ajax.feed.php**

Carpetas para el backup:
* inc/**smarty**/
* themes/_TU_TEMA_/**js**/
---
Si actualizaste **jQuery** sigue estos pasos:

1 - En js/**cuenta.js** busca
```js
      if ($.browser.opera) document.getElementById(frameId).onload = uploadCallback;
      else {
         if (window.attachEvent) document.getElementById(frameId).attachEvent('onload', uploadCallback);
         else document.getElementById(frameId).addEventListener('load', uploadCallback, false);
      }
```
y reemplazala por
```js
      if (window.attachEvent) document.getElementById(frameId).attachEvent('onload', uploadCallback);
      else document.getElementById(frameId).addEventListener('load', uploadCallback, false);
```

> Obviamente fue basado en los actualizadores de "smarty" y el de "jquery"
