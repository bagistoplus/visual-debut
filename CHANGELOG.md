# Changelog

All notable changes to `Bagisto Visual Debut` will be documented in this file.

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
