# Changelog

All notable changes to `Bagisto Visual Debut` will be documented in this file.

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
