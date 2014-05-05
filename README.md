# CakeWX

**CakeWX** 是一个由PHP写的的免费的开源微信公众号管理平,遵循 [MIT License](https://github.com/niancode/CakeWX/blob/master/LICENSE).

他是基于 [CakePHP](http://www.cakephp.org) MVC 框架.

## Requirements
  * Apache with `mod_rewrite`
  * PHP 5.2 or higher
  * MySQL 4.1 or higher

## Installation

#### Web based installer

  * Extract the archive. Upload the content to your server.
  * Create a new MySQL database (`utf8_general_ci` collation)
  * visit http://your-site.com/ from your browser and follow the instructions.

#### Manual installation

  * Extract the archive. Upload the content to your server.
  * Create a new MySQL database (`utf8_unicode_ci` collation), and use these two SQL dump files in given order:
    * `app/Config/Schema/sql/cakewx.sql`
    * `app/Config/Schema/sql/cakewx_data.sql`
  * Rename:
    * `app/Config/database.php.install` to `database.php`, and edit the details.
    * `app/Config/cakewx.php.install` to `cakewx.php`, and edit the details.
    * `app/Config/settings.json.install` to `settings.json`
  * You can access your admin panel at http://your-site.com/admin. The installer should
    display a page for you to create the administrative user.

It is recommended that you install Croogo using the web based installer for security reasons.

#### Installation using git

  * Ensure you have a recent cakephp version 2.3
  * Run `git submodule update --init`
  * After running the web installer, you will need to generate the assets:

	`Console/cake croogo make` that will fetch twitter bootstrap and FontAwesome
	and subsequently compile the CSS assets using lessphp.

	Alternatively, you could use `lessc` or `recess` as the compiler as they
	generate a better result.  Edit the `COMPILE` value in the `Makefile`
	accordingly and run:

	`( cd Plugin/CakeWX ; make )`

## Links

  * **Official website**: [http://cakewx.com](http://cakewx.com)
  * **Downloads**: [http://downloads.cakewx.org](http://downloads.cakewx.com)
