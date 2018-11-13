## Jetpack Smooth Generator

Inspired by [WooCommerce Smooth Generator](https://github.com/woocommerce/wc-smooth-generator), Jetpack Smooth Generator creates dummy content via the command line interface providing the site with different combinations of posts and Jetpack settings. 

## Example usage

Generate 12 posts

```sh
wp jetpack generate posts 12
```

Generate random combination of Jetpack settings

```sh
wp jetpack generate settings
```

## Development

The `features` directory contains a file for each subcommand added on top of `wp jetpack generate`. 


## License

GPL2
