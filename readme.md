p2lj
====

Post to [LiveJournal](http://livejournal.com) via PHP.

To post using the script, include `p2lj.php` and use the function `p2lj()`.

The function needs folowing arguments:   	
`login` — your login in LJ system,  
`passw` — password of your account,  
`subj` — subject of the entry,  
`text` — entire text.

It returns an **array** or **false**.

The array contains:  
`itemid` – post ID,  
`url` – post URL,  
`anum` — authorization token.  

Example
-------

```php

@include 'p2lj.php';

if ($_POST) {
  $post = p2lj($_POST['login'], $_POST['password'], $_POST['subject'], $_POST['message']);
  echo is_array($post) ? $post['url'] : 'Error while posting';
}
	
```

License
-------

p2lj is an opensource project.  
© 2012, under the [MIT license](http://github.com/rozzy/p2lj/blob/master/license)