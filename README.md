This is an extension for [thephpleague/commonmark](https://github.com/thephpleague/commonmark)
to parse [MultiMarkdown-like metadata](https://fletcher.github.io/MultiMarkdown-4/metadata.html) from the top of a Markdown file.

# Installation

1. Require the package like any other:
```
composer require rianfuro/commonmark-metadata
```

2. Install the extension.

```php
use CommonMark\Extension\Metadata\MetadataExtension;

$environment = new Environment([]);
// ... other extensions
$environment->addExtension(new MetadataExtension);

new MarkdownConverter($environment);
```

# Usage

The extension is used automatically by the CommonMark Parser when included. The extension converts the metadata section into a `MetadataBlock`,
which holds the fields in it's `data` property. You can, for example, use CommonMark's query utility to fetch the Block and get it's data:
```php
$metadata = (new Query())
  ->where(Query::type(MetadataBlock::class))
  ->findOne($document);
  
$metadata->data->export(); // note that this always includes the default `attributes` field
```

# Current limitations

The project is in it's super early stages so the parsing is very limited. 
Currently the metadata needs to be fenced with yaml-style delimiters (should be optional according to the spec):
```markdown
---
Author: Me
Title: Super Awesome Document
---

My Amazing Markdown Document
============================

...
```
Additionally, the metadata fields cannot be referenced inside the document.
