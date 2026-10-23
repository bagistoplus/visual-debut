# Changelog

All notable changes to `Bagisto Visual Debut` will be documented in this file.

# [2.0.0-alpha.13](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.12...v2.0.0-alpha.13) (2026-10-23)


### Bug Fixes

* **a11y:** make the header cart title a paragraph so it does not precede the page's h1 ([164399b](https://github.com/bagistoplus/visual-debut/commit/164399b67baca4f62d2684f1a7239800346f84a5))
* **a11y:** name product card links and footer social buttons, and fix the filters heading level ([d290544](https://github.com/bagistoplus/visual-debut/commit/d290544087da2930817b641026231c8847f7dc43))
* **accordion:** render panels in their starting state and transition only on toggle ([61376ce](https://github.com/bagistoplus/visual-debut/commit/61376ce7416cc234dd675c43bb19ec105c156537))
* **account:** show a refund's own discount and total ([fbb6603](https://github.com/bagistoplus/visual-debut/commit/fbb660398cbf4c2ab630970541280d25f354275b))
* **account:** translate the pending payment order status ([dca7576](https://github.com/bagistoplus/visual-debut/commit/dca757623ac042319a9a1e6d7f8f25986b1da59f))
* **address-form:** keep the saved state selected on the edit page ([03234f1](https://github.com/bagistoplus/visual-debut/commit/03234f1fd9b5988a9c3c9688a63da1618d4d5758))
* **breadcrumbs:** show breadcrumbs on account pages ([4e37df1](https://github.com/bagistoplus/visual-debut/commit/4e37df139b6370fc7452e14f14dd5b76cc06cc65))
* **carousel:** hide arrows with nowhere to go and a single dot ([021c15c](https://github.com/bagistoplus/visual-debut/commit/021c15c3399950818a69e3891429d36b574c1705))
* **cart:** update the cart summary when a shipping estimate is picked ([790ac00](https://github.com/bagistoplus/visual-debut/commit/790ac0085207227bad1dca8d079c3bf2b3c3352e))
* **catalog-cache:** flush after deletes and on product imports ([b9e1b77](https://github.com/bagistoplus/visual-debut/commit/b9e1b77818777d45ca1d45bdf9e559c16ce66b79))
* **checkout:** keep edited addresses after proceed ([7f1d72c](https://github.com/bagistoplus/visual-debut/commit/7f1d72cef3a3e1d65ea1d6d932dfcf486b0fad2c))
* **checkout:** label the phone field on Bagisto 2.5 ([cef2c10](https://github.com/bagistoplus/visual-debut/commit/cef2c1054ba1866c2c4c7922703f46a5912ff776))
* **checkout:** reach PayPal's smart button routes on Bagisto 2.5 ([cd02925](https://github.com/bagistoplus/visual-debut/commit/cd0292564b7090632f666f355cd16ad756071ab3))
* **checkout:** render PayPal's smart button and show its errors ([9141dda](https://github.com/bagistoplus/visual-debut/commit/9141ddabf4526efb2fab968dc4950fa54c830fe9))
* **checkout:** send an empty cart back to the cart page ([0dc7912](https://github.com/bagistoplus/visual-debut/commit/0dc79127a7c0f8cc53cbdf9aa697bfd18b8456d8))
* **checkout:** show address validation errors and keep field edits between requests ([cdeb5ff](https://github.com/bagistoplus/visual-debut/commit/cdeb5ff0298dc0ffc0b3018fac8c7e155c74fcbd))
* **checkout:** show the ordered variant, its options and every total on the success page ([be01221](https://github.com/bagistoplus/visual-debut/commit/be0122165f1d7bda9a6d1bd7e74d1ec7f73d5d27))
* **checkout:** stop listing the cart's copy of a saved address on reload ([5d2f527](https://github.com/bagistoplus/visual-debut/commit/5d2f527888151064e592d6134e5ffc289ff81ca2))
* **filters:** hide the price filter when no product has a price ([1da28f8](https://github.com/bagistoplus/visual-debut/commit/1da28f858c39f17be5c94349217e8a2266db513f))
* **filters:** leave room for the checkbox focus ring in the scrolling option list ([b8e4138](https://github.com/bagistoplus/visual-debut/commit/b8e41382dc8dcb4ce2358c5177be9786851aa93d))
* **flash:** keep session flashes for the next page when a Livewire action redirects ([40b3e20](https://github.com/bagistoplus/visual-debut/commit/40b3e20df8335ec50387665c3b7f80f52c507158))
* **form:** keep an empty textarea empty ([c17fbde](https://github.com/bagistoplus/visual-debut/commit/c17fbde45735769b3ff1c26c8e49f86842e60284))
* **gdpr:** clip long request messages in the list ([f1cec74](https://github.com/bagistoplus/visual-debut/commit/f1cec7434ab3e503d9de41e441f88c816b00d0fe))
* **header-cart:** close the preview when the cart empties ([3991336](https://github.com/bagistoplus/visual-debut/commit/3991336a4a3ea852f2b7a6ddcf6623f0c2928d83))
* **header-cart:** refresh the badge when a quantity change empties an item ([f4277c3](https://github.com/bagistoplus/visual-debut/commit/f4277c3d3efa91af021a13c436bc277025f8cb80))
* **header:** show the nav bar from 1024px and the drawer below ([669b0d3](https://github.com/bagistoplus/visual-debut/commit/669b0d3c4de6207664f148a5970c3262c28da288))
* **order-details:** link invoice prints on Bagisto 2.5 ([99b079a](https://github.com/bagistoplus/visual-debut/commit/99b079a4367c611eac6006965d9973743c0c4c30))
* **order-details:** show the address country on Bagisto 2.5 ([89bead6](https://github.com/bagistoplus/visual-debut/commit/89bead6ff18c1bda0ffa881f5728a648c61420fe))
* **order-details:** show the quantity on mobile invoice items ([e9d86ee](https://github.com/bagistoplus/visual-debut/commit/e9d86eef84cf15dc364c7055a157a5e864c2c772))
* **order-details:** tolerate order items without attributes ([1bc8d36](https://github.com/bagistoplus/visual-debut/commit/1bc8d36d834b0f73ad1fa62729877b057129a219))
* **product-bundle:** send each bundle option as a list so a changed radio or select adds to cart ([2df6997](https://github.com/bagistoplus/visual-debut/commit/2df6997a51fbbb5ace57d817baa979844a2939f2))
* **product-information:** show a failed add in place when Bagisto sends no redirect ([75f1f00](https://github.com/bagistoplus/visual-debut/commit/75f1f00a37fc07805227acf82185cbe23f69af33))
* **product-list:** hide a list with no products outside the editor ([c1ae7df](https://github.com/bagistoplus/visual-debut/commit/c1ae7df56967f95652fe028afe9e9649423f8194))
* **product-list:** select products by the storefront filters instead of product_flat ([e3281c6](https://github.com/bagistoplus/visual-debut/commit/e3281c61e8d6379756165b2e34e8d602f0fe3094))
* **product-reviews:** show the review form's validation errors ([d27a28a](https://github.com/bagistoplus/visual-debut/commit/d27a28a1c79595c742eb0e46655e87d7f1cf62e9))
* **product:** keep variant swatches on one line when they fit, and stop option buttons submitting the form ([bc5933c](https://github.com/bagistoplus/visual-debut/commit/bc5933c5543d9727128c050c37639e1780931400))
* **product:** let the shopper choose every variant option instead of selecting the first variant ([877f260](https://github.com/bagistoplus/visual-debut/commit/877f260977f6085f42bb88947e20c6b9c241ba94))
* **product:** render variant options on the server so the page does not shift, and wrap colour and image swatches ([ee5f25a](https://github.com/bagistoplus/visual-debut/commit/ee5f25aa0a12b851f70d8efa8e3c6182e79aeb10))
* **quantity-selector:** restore the last quantity when the field is emptied ([3c7dfba](https://github.com/bagistoplus/visual-debut/commit/3c7dfba1e6fcb0e24f2e87da95e84ca191cc7708))
* **reviews:** use the heading font for the reviews title ([b1cf895](https://github.com/bagistoplus/visual-debut/commit/b1cf8956d6798ea0cc99da4955d8ff06af6704b6))
* **rma:** use one Hindi word for returns ([6196bf6](https://github.com/bagistoplus/visual-debut/commit/6196bf69a41cc0b2ef50c65b2d027320ca8dccef))
* **toasts:** keep long titles clear of the close button ([c272955](https://github.com/bagistoplus/visual-debut/commit/c272955e7148807d746daaae1225f1462c5da35b))
* **ui:** follow the theme's radius settings across pages ([faccaa2](https://github.com/bagistoplus/visual-debut/commit/faccaa2f7c4a4cad30cda16b3507fc03f9d85d5a))
* **ui:** lay out the withdrawal and account overview pages for phones ([1804f94](https://github.com/bagistoplus/visual-debut/commit/1804f94fce5d1fc4832c73983a547aaf6ba7766d))
* **validation:** drop the uploaded override that blocked Bagisto's validation messages ([9b043e6](https://github.com/bagistoplus/visual-debut/commit/9b043e61e82f08963bbe42fd8e8d74c0906886d0))
* **variant-picker:** size text swatch buttons to their labels ([fac53e1](https://github.com/bagistoplus/visual-debut/commit/fac53e13eb9acaf1f26150b2a6d0d74908f674ac))
* **withdrawal:** support EU withdrawal on Bagisto 2.4.8 ([d198ff7](https://github.com/bagistoplus/visual-debut/commit/d198ff7229a6d4fd91b70e8eaf9a3c3ac5dc0e49))


### Features

* **account:** add an account overview page ([8eefa6f](https://github.com/bagistoplus/visual-debut/commit/8eefa6fbb2a3a79d8ec253dfc08abe5bb5a9d748))
* **account:** show the shipment carrier in order details ([e465ebf](https://github.com/bagistoplus/visual-debut/commit/e465ebfba5461d9ec9a0219ef41158dc0963285b))
* **cart:** show taxes, shipping and discounts in the summary as Bagisto 2.4.12 and later do ([d0776bb](https://github.com/bagistoplus/visual-debut/commit/d0776bb9e99f39b703696671b6a332cd972072c2))
* **checkout:** show a page loader while PayPal captures the payment ([9a20b9d](https://github.com/bagistoplus/visual-debut/commit/9a20b9d291a414593bef470b32d7a739d5c5e067))
* **checkout:** show each item's options in the checkout summary ([6ff089b](https://github.com/bagistoplus/visual-debut/commit/6ff089bf49e8adfc30a815255ad39c2327daedbf))
* **checkout:** show shipping and payment methods two per row ([6fda2a4](https://github.com/bagistoplus/visual-debut/commit/6fda2a4f9a13a572c622ef4adf4e6259656d3c51))
* **colors:** add a light scheme and use it for the newsletter ([282ec55](https://github.com/bagistoplus/visual-debut/commit/282ec55e17137169cc58ac294adb39deab7cae0b)), closes [#f8f5f0](https://github.com/bagistoplus/visual-debut/issues/f8f5f0)
* **colors:** rework the dark scheme, add a black scheme and drop the rest ([8146a40](https://github.com/bagistoplus/visual-debut/commit/8146a4061130230a0537063b24eb65b793e6035c))
* **colors:** rework the default color scheme for contrast across pages ([614886c](https://github.com/bagistoplus/visual-debut/commit/614886ce84377ddef7ccc0f52e03b14fb436f59c)), closes [#f7f7f7](https://github.com/bagistoplus/visual-debut/issues/f7f7f7) [#efefef](https://github.com/bagistoplus/visual-debut/issues/efefef) [#1f1b18](https://github.com/bagistoplus/visual-debut/issues/1f1b18) [#b7791f](https://github.com/bagistoplus/visual-debut/issues/b7791f) [#6b645e](https://github.com/bagistoplus/visual-debut/issues/6b645e) [#c2410c](https://github.com/bagistoplus/visual-debut/issues/c2410c)
* **filters:** tick facets client side with a search and a capped height ([1c07431](https://github.com/bagistoplus/visual-debut/commit/1c0743114a4f3249bf858e64a8737f6468a9b7e9))
* **gdpr:** add a helper for what the store's GDPR requests support ([e8f752d](https://github.com/bagistoplus/visual-debut/commit/e8f752da761b11e48240e066b379a9e3e8d581ca))
* **gdpr:** add the customer GDPR requests list ([9301d3d](https://github.com/bagistoplus/visual-debut/commit/9301d3dd385f276ec7b24cbb0d50784f52cd2294))
* **gdpr:** ask for the terms agreement at sign-up ([86ce2dc](https://github.com/bagistoplus/visual-debut/commit/86ce2dc4851e166795b4a72919f29190cbb91a8f))
* **gdpr:** ask visitors for cookie consent ([169a1aa](https://github.com/bagistoplus/visual-debut/commit/169a1aa82faef5901144131385ce8a7e74e7c18a))
* **gdpr:** let customers create a GDPR request ([5a8cfc1](https://github.com/bagistoplus/visual-debut/commit/5a8cfc1944de2bb968bfe235e23423ff3afac6e5))
* **gdpr:** let customers revoke a pending request ([955fe6e](https://github.com/bagistoplus/visual-debut/commit/955fe6e3601926aafe149f48a0bdb43dd9509e82))
* **gdpr:** render the cookie preferences page ([1dca5a5](https://github.com/bagistoplus/visual-debut/commit/1dca5a5036fa71276a4ddffbe8f275e2f632773a))
* **header:** make the sticky header a setting ([9455925](https://github.com/bagistoplus/visual-debut/commit/9455925e8e99147e3008528eaecf8fcd3b64a3f2))
* **homepage:** ship a richer default homepage built from presets ([49e0c1a](https://github.com/bagistoplus/visual-debut/commit/49e0c1abe594ce1838a8b6fc89a6c070c9dd1805))
* **layout:** output the merchant's custom CSS and JavaScript ([fa68735](https://github.com/bagistoplus/visual-debut/commit/fa6873592e1c20d34c5a67decee6e1e1884293c1))
* **listing:** show a message when a category or search has no products ([31deb1e](https://github.com/bagistoplus/visual-debut/commit/31deb1e07178af72fcd48e09cffe566c719a723c))
* **order-details:** warn when canceling leaves booking items active ([3d6edd6](https://github.com/bagistoplus/visual-debut/commit/3d6edd6b84ca4eec3e0e2f6f565c7e82c3261d60))
* **product:** add a product recommendations section for related products and up-sells ([82ff0cd](https://github.com/bagistoplus/visual-debut/commit/82ff0cde4cf06e6c6fa8c98dd1967ed3faaac48d))
* **product:** book default and appointment booking products ([9a274f9](https://github.com/bagistoplus/visual-debut/commit/9a274f956a1a6b89409a4f17a82e16e348f1e837))
* **product:** book event tickets with a live summary ([0beff02](https://github.com/bagistoplus/visual-debut/commit/0beff025ce8b9baf1ceb6b493c3667e2630b6409))
* **product:** book tables for a party with an optional note ([50d5980](https://github.com/bagistoplus/visual-debut/commit/50d5980d88b46248f815d091a88230d094604451))
* **product:** migrate saved templates to the product options block ([4865fea](https://github.com/bagistoplus/visual-debut/commit/4865fea459c7dcb975f6cb37960a27d9d0d01813))
* **product:** pick every product type's options from one block ([fb7be9d](https://github.com/bagistoplus/visual-debut/commit/fb7be9dd33dcd3e0b321129b6770dd8a20c16805))
* **product:** rent booking products by the day or the hour ([762698e](https://github.com/bagistoplus/visual-debut/commit/762698ef99a58ec27abd804a94b094ff6518951b))
* **product:** show the lowest price before a discount ([d44955e](https://github.com/bagistoplus/visual-debut/commit/d44955e521c1409d806b5342e4e4cf6af3de0dde))
* **rma:** add a helper for what the store's returns support ([447a93e](https://github.com/bagistoplus/visual-debut/commit/447a93eb04f03db6094535bf5dc96aeda4f83fd6))
* **rma:** add the customer return request page ([9d5b99b](https://github.com/bagistoplus/visual-debut/commit/9d5b99b2bf06887a811a757f6a7c12d4ab7eacf7))
* **rma:** add the customer returns list ([6c692a5](https://github.com/bagistoplus/visual-debut/commit/6c692a52c19403af6482d20a0c457ae32f644b04))
* **rma:** add the new return request page ([1e2b1cf](https://github.com/bagistoplus/visual-debut/commit/1e2b1cfd726c2d9b114260d354c3a8275de14512))
* **rma:** offer a return from the order page ([caf6625](https://github.com/bagistoplus/visual-debut/commit/caf6625a1e3220aa0c8e25cea39c512703545418))
* **sections:** give every section a color scheme setting ([a46f364](https://github.com/bagistoplus/visual-debut/commit/a46f364717836eb2e45a64205f1b680865754e36))
* **settings:** default the button, box and input radius to xl ([e7b67c0](https://github.com/bagistoplus/visual-debut/commit/e7b67c08324b6a79edd12ee5373df9fde3e13df4))
* **typography:** load the medium, semibold and bold weights the templates use ([e5bc93e](https://github.com/bagistoplus/visual-debut/commit/e5bc93e733885a0e50a09e4f90ab9cac1d832a63))
* **ui:** move Debut's UI primitives onto @bagistoplus/ui ([b776b6c](https://github.com/bagistoplus/visual-debut/commit/b776b6cfdf2f0de7720bc8074c58c235c8bbdf7d))
* **webmcp:** expose the store's actions to AI agents ([ae1f6f6](https://github.com/bagistoplus/visual-debut/commit/ae1f6f6a26fd2b08c4f86b88b293645fe8fa10de))
* **withdrawal:** add the EU withdrawal pages ([0854966](https://github.com/bagistoplus/visual-debut/commit/0854966b6980ffa6a46d0acec3d6a0d804bcf06b))


### Performance Improvements

* **gallery:** render the first image on the server and reserve the thumbnail row ([a3dbc8c](https://github.com/bagistoplus/visual-debut/commit/a3dbc8c8397803f4994818f3d677daba7e923d6b))
* **hero:** load the hero background first ([7f66399](https://github.com/bagistoplus/visual-debut/commit/7f6639958d05199ff0c1d728b817a84063ac96a4))
* **images:** lazy-load offscreen images and load the gallery and banner first ([3fc8821](https://github.com/bagistoplus/visual-debut/commit/3fc8821785f3bcaa6bfb5edc3c38d8a616690070))
* **js:** load page-specific ui components on demand ([514b253](https://github.com/bagistoplus/visual-debut/commit/514b253ee3ed2bfcdf37f7a5278c457ee9764b66))
* **listing:** cache catalog results and drop per-card livewire buttons ([f635a3d](https://github.com/bagistoplus/visual-debut/commit/f635a3d2ad8b4e19f29caf2ca4e197b7ecf82476))
* **locale:** read the channel's locales relation instead of querying off it ([54df3a2](https://github.com/bagistoplus/visual-debut/commit/54df3a2cc889ec5e69994ac4435388805c960026))

# [2.0.0-alpha.12](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.11...v2.0.0-alpha.12) (2026-09-10)


### Bug Fixes

* keep header cart and flashes per shopper under the full page cache ([731d301](https://github.com/bagistoplus/visual-debut/commit/731d30128cdebed9568576bacb14cc39782ad305))
* listen for the correct cart updated event in the variant picker ([4bcf139](https://github.com/bagistoplus/visual-debut/commit/4bcf139ec64cf0982993f59a284d44b1eeb52f38))


### Features

* dispatch a compare updated event on compare changes ([d1e38b0](https://github.com/bagistoplus/visual-debut/commit/d1e38b065fad6a67bab3dfa3fbc36a370bc08597))
* dispatch a wishlist updated event on wishlist changes ([9c7d429](https://github.com/bagistoplus/visual-debut/commit/9c7d42957f330ff942804581937bd8b500ea7ab2))

# [2.0.0-alpha.11](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.10...v2.0.0-alpha.11) (2026-09-08)


### Bug Fixes

* guard category and product card links against missing url ([6a9f13f](https://github.com/bagistoplus/visual-debut/commit/6a9f13ffc372a1efe4ac364569ad1c581128c17a))
* handle Bagisto image search upload response object ([23e45de](https://github.com/bagistoplus/visual-debut/commit/23e45de4872db7187c2923598934e64ea1baa875))
* move section padding inside container wrapper ([75bb5b2](https://github.com/bagistoplus/visual-debut/commit/75bb5b2cc7484fb5ae24e47837e8823df3e9af2f))
* order carousels, render datagrid slot, drop legacy tailwind config ([6d7e9ed](https://github.com/bagistoplus/visual-debut/commit/6d7e9ed6ee1ed80e1a7cb475fbf9f734fa4bb851))
* skip category card link when url_key is missing ([7e43c80](https://github.com/bagistoplus/visual-debut/commit/7e43c8024c7208b19a907b05c2f8e8320dd6294e))


### Features

* add wrap in card and shadow settings to category card ([4bb162f](https://github.com/bagistoplus/visual-debut/commit/4bb162f9c7cd2d44fece4aaa7fab4ba9e7d9a97b))
* add wrap in card and shadow settings to product card ([57dc5d5](https://github.com/bagistoplus/visual-debut/commit/57dc5d5a216b3892dfad9eddabcf8bb2b37de28e))
* support Bagisto 2.5 and Laravel 13 ([e6cd897](https://github.com/bagistoplus/visual-debut/commit/e6cd8971529587b80f4dfc66b1c5f50ff915dba6))

# [2.0.0-alpha.10](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.9...v2.0.0-alpha.10) (2026-06-22)


### Bug Fixes

* add blade remix icons dependency ([74b6cb1](https://github.com/bagistoplus/visual-debut/commit/74b6cb115aa0ee7a3c6d9a8ab667e5be6cfb8b16))

# [2.0.0-alpha.9](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.8...v2.0.0-alpha.9) (2026-06-22)


### Bug Fixes

* allow icon button clicks through ([71ecdf6](https://github.com/bagistoplus/visual-debut/commit/71ecdf6c8be6ce2925abec82e2bc06d3f39e4a30))
* support rtl carousel controls ([e7bf0c0](https://github.com/bagistoplus/visual-debut/commit/e7bf0c03f303bd00ebdfbeac68ac4bf19dfbb648))
* use visual translation helper ([b9cea94](https://github.com/bagistoplus/visual-debut/commit/b9cea944ebf3a569b48fdc7ffab1fa4a58f8e160))

# [2.0.0-alpha.8](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.7...v2.0.0-alpha.8) (2026-06-18)


### Bug Fixes

* translate production view strings ([ba63644](https://github.com/bagistoplus/visual-debut/commit/ba636446a0cd941bba3c3e82e924b7e2f630203f))

# [2.0.0-alpha.7](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.6...v2.0.0-alpha.7) (2026-06-17)


### Bug Fixes

* **deps:** update visual alpha ([78cfbdf](https://github.com/bagistoplus/visual-debut/commit/78cfbdf76ee57fa5e207438f1659beb6dda608ed))

# [2.0.0-alpha.6](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.5...v2.0.0-alpha.6) (2026-06-17)


### Bug Fixes

* adjust product review typography ([41ca0eb](https://github.com/bagistoplus/visual-debut/commit/41ca0ebe25c74b8b3b456babbec3f6a84ba174e8))
* guard missing order attribute type ([8d3eabc](https://github.com/bagistoplus/visual-debut/commit/8d3eabcbcb6bdaa08e823c44a195a3a4b4cb5f36))
* improve header navigation dropdown ([504a8a8](https://github.com/bagistoplus/visual-debut/commit/504a8a8b0c869aa1bb594c55aa58392739a025e5))
* refine footer preset styling ([83064dc](https://github.com/bagistoplus/visual-debut/commit/83064dc392078e8a28c9cab4dd9bfb7e04b00aaa))
* remove accordion typography setting ([2371454](https://github.com/bagistoplus/visual-debut/commit/2371454aa0d28d1ec68cc1319c53d831754201e4))
* update account sidebar icons ([eb2b745](https://github.com/bagistoplus/visual-debut/commit/eb2b74574146b650b960829133f40357be1a23ea))
* update list section presets ([3e29b0e](https://github.com/bagistoplus/visual-debut/commit/3e29b0e5cae55adb60869df63e113c5c9b7ce657))
* use basic blocks tailwind helper ([5aa89d5](https://github.com/bagistoplus/visual-debut/commit/5aa89d5d70bed756edae08a0ecf8816acffc9022))


### Features

* add header nav category controls ([0f40168](https://github.com/bagistoplus/visual-debut/commit/0f401683c79eb4a57915a9cc598f12b05e99f0ee))
* localize visual editor names ([620383d](https://github.com/bagistoplus/visual-debut/commit/620383d541581b11fefb76da313f68209174fe19))

# [2.0.0-alpha.5](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.4...v2.0.0-alpha.5) (2026-06-03)


### Features

* safelist flex-{row,col}-reverse with responsive variants ([ed592c0](https://github.com/bagistoplus/visual-debut/commit/ed592c05c38a132987cc47f6a5cbd5e25b0b457f))

# [2.0.0-alpha.4](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.3...v2.0.0-alpha.4) (2026-05-27)


### Bug Fixes

* update visual compatibility ([c77c138](https://github.com/bagistoplus/visual-debut/commit/c77c1388e510c7e6e3a74c6870c9d215c77445ca))

# [2.0.0-alpha.3](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.2...v2.0.0-alpha.3) (2026-05-05)


### Features

* support Livewire 4 ([9de8e0f](https://github.com/bagistoplus/visual-debut/commit/9de8e0f4bd9523ebcea3b2b9a30eaad9d3118268))

# [2.0.0-alpha.2](https://github.com/bagistoplus/visual-debut/compare/v2.0.0-alpha.1...v2.0.0-alpha.2) (2026-05-05)


### Features

* support image focal point metadata ([be75a7b](https://github.com/bagistoplus/visual-debut/commit/be75a7b65e23a40f591854ec434f11b834a883db))

## 2.0.0-alpha.1 (2026-05-04)

### Features

- integrate Bagisto Visual 2
- add Basic Blocks package integration
- add Product List and Category List carousel layouts
- add customizable product option rendering across cart and order surfaces
- add responsive typography, spacing, width, and breakpoint improvements

### Fixes

- improve checkout, cart, product card, product description, and header block behavior
- pin compatible Livewire version
- update generated assets for the new frontend bundle

### Refactors

- replace duplicated Visual Debut basic blocks with Basic Blocks package classes
- convert block presets and accepts to class references
- centralize typography and spacing behavior
- remove obsolete local carousel implementation in favor of `alpine-headless-ui`
