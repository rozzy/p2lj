p2lj
====

Post to [LiveJournal](http://livejournal.com) via PHP.

To post using the script, include `p2lj.php` and use the function `p2lj()`.

The function needs folowing arguments:   	
`login` — your login in LJ system,  
`passw` — password of your account,  
`subj` — subject of the entry,  
`text` — entire text,  
`props` — array with other optional information ([all available props](http://www.livejournal.com/doc/server/ljp.csp.proplist.html)).

It returns an **array** or **false**.

The array contains:  
`itemid` – post ID,  
`url` – post URL,  
`anum` — authorization token.  

Example
-------

```php

require 'p2lj.php';

$post = p2lj(
	'navalny',
	'qwertykremlin',
	'How to make Russia a better place to live', 
	'Lorem ipsum dolor sit amet <...>',
	array(
		'taglist' => 'russia, putin, p2lj',
		'current_music' => 'Shlohmo: I can‘t see you'
	)
);
echo is_array($post) ? $post['url'] : 'Error while posting';
	
```

License
-------

p2lj is an opensource project.  
© 2012, under the [MIT license](http://github.com/rozzy/p2lj/blob/master/license)
