# `p2lj`

Post to [LiveJournal](http://livejournal.com) via PHP.

To post using the script, include `p2lj.php` and use the function `p2lj()`.

The function needs folowing arguments:
- `username`: your username
- `password`: your password
- `subject`: the subject of the post
- `text`: the entire text
- `props`: an array with other optional information, [see the list](http://www.livejournal.com/doc/server/ljp.csp.proplist.html)

It returns an array or `false`.

The array contains:
- `itemid`: post ID
- `url`: post URL
- `anum`: authorization token

## Example

```php

require 'p2lj.php';

$post = p2lj(
	'navalny',
	'qwertykremlin',
	'How to make Russia a better place to live', 
	'O tempora, o mores! <...>',
	array(
		'taglist' => 'russia, putin, bears',
		'current_music' => "Shlohmo: I Can't See You I'm Dead"
	)
);

echo $post ? $post['url'] : 'Putin has rejected your request';
```
