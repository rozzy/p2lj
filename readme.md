p2lj
====

LJ via PHP.

To post using this script, upload `/lib/` on your server and include `/lib/raw.p2lj.php` and use function `p2lj()`.

Function needs folowing parameters:   	
`login` — your login in LJ system,  
`passw` — password of your account,  
`subj` — subject of the entry,  
`text` — entire text.

It returns an array or **false**.

The array contains:  
`itemid` – post ID,  
`url` – post URL,  
`anum` — authorization token.  

Example:

```php

@include '/lib/raw.p2lj.php';

if ($_POST) {
  $post = p2lj($_POST['login'], $_POST['password'], $_POST['subject'], $_POST['message']);
  echo is_array($post) ? $post['url'] : 'Error while posting';
}
	
```
