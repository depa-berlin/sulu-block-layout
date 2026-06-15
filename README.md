# sulu-block-layout

Layout block collection for Sulu CMS — 3 composite layout blocks for FAQ sections, hero areas and media-text combinations.

## Included Blocks

| Block | Description |
|---|---|
| `block--layout-faq` | FAQ section with expandable items |
| `block--layout-hero` | Hero layout block with configurable content areas |
| `block--layout-media-text` | Side-by-side media and text layout |

## Requirements

- PHP 8.2+
- Symfony 7.0+
- Sulu CMS 3.0+
- `depa/sulu-block-helper`
- `depa/sulu-block-content` (referenced block types)

## Installation

```bash
composer require depa/sulu-block-layout
```

Register in `config/bundles.php`:

```php
Depa\SuluBlockHelperBundle\SuluBlockHelperBundle::class  => ['all' => true],
Depa\SuluBlockLayoutBundle\SuluBlockLayoutBundle::class   => ['all' => true],
```

## License

Proprietary — Copyright (c) depa Berlin GmbH & Co. KG. All rights reserved.
See [LICENSE](LICENSE) for details.
