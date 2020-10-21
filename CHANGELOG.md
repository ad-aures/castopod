# [1.0.0-alpha.7](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.6...v1.0.0-alpha.7) (2020-10-21)


### Features

* **analytics:** add service name from rss user-agent ([7202b98](https://code.podlibre.org/podlibre/castopod/commit/7202b9867bd59aafa8c338a4230fb5e5c55b24c6))


### BREAKING CHANGES

* **analytics:** analytics_podcasts_by_player table and analytics_podcasts procedure were updated

# [1.0.0-alpha.6](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.5...v1.0.0-alpha.6) (2020-10-20)


### Bug Fixes

* **cache:** add locale for podcast and episode pages + clear some persisting cache in models ([9cec8a8](https://code.podlibre.org/podlibre/castopod/commit/9cec8a81ccbb7239402fe6633dbc31979272302a)), closes [#42](https://code.podlibre.org/podlibre/castopod/issues/42) [#61](https://code.podlibre.org/podlibre/castopod/issues/61)

# [1.0.0-alpha.5](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.4...v1.0.0-alpha.5) (2020-10-20)


### Features

* add lock podcast according to the Podcastindex podcast-namespace to prevent unauthozized import ([72b3012](https://code.podlibre.org/podlibre/castopod/commit/72b301272e0b70ded3e2b237391909e3f152ad0b))

# [1.0.0-alpha.4](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.3...v1.0.0-alpha.4) (2020-10-20)


### Features

* **analytics:** add charts and data export ([78625c4](https://code.podlibre.org/podlibre/castopod/commit/78625c471b4f03a09bd42f72b82217e1f2d01cef))

# [1.0.0-alpha.3](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.2...v1.0.0-alpha.3) (2020-10-19)


### Bug Fixes

* **analytics:** remove charts empty values + remove useless language cache ([1678794](https://code.podlibre.org/podlibre/castopod/commit/16787941539ba4014281a366789ea896a9cd2afc))

# [1.0.0-alpha.2](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.1...v1.0.0-alpha.2) (2020-10-19)


### Features

* add cumulative listening time charts ([588b4d2](https://code.podlibre.org/podlibre/castopod/commit/588b4d28da00bc12d02126e23181690f54d81716))

# 1.0.0-alpha.1 (2020-10-16)


### Bug Fixes

* add public/media folder to castopod bundle ([8053d35](https://code.podlibre.org/podlibre/castopod/commit/8053d3521b481872711dabaaf265d08b9bfbaa87)), closes [#52](https://code.podlibre.org/podlibre/castopod/issues/52)
* add where condition to get episode count without deleted episodes ([7661734](https://code.podlibre.org/podlibre/castopod/commit/7661734ed296654630f3668132671117519145dd)), closes [#67](https://code.podlibre.org/podlibre/castopod/issues/67)
* comment all cache clean after page update to prevent analytics cache deletion ([e6197a4](https://code.podlibre.org/podlibre/castopod/commit/e6197a4972a3cce3d67dd7972bb54f8720b8e5b7))
* correct chart data ([4d3e9c8](https://code.podlibre.org/podlibre/castopod/commit/4d3e9c8c02cdc882e9fe1c29625695b6f83c820a))
* correct percona compatibility issue ([e53f819](https://code.podlibre.org/podlibre/castopod/commit/e53f819264b2d6902996f11ffcbb7c99295a90ef))
* correct php-fpm issues ([1ef55d7](https://code.podlibre.org/podlibre/castopod/commit/1ef55d7315bb44abe05f02ec8a84b6b6a557a9a0))
* correct referrer bug ([ed69b2f](https://code.podlibre.org/podlibre/castopod/commit/ed69b2f5004ed1cd18bac824c08a0df01f5d2637))
* correction for servers with low int precision ([31b7828](https://code.podlibre.org/podlibre/castopod/commit/31b7828e77519ef43e9bcfcbdf6c21712f97a571))
* declare typed properties in PHPDoc for php<7.4 ([14dd44d](https://code.podlibre.org/podlibre/castopod/commit/14dd44d03d6db0d9ae4198db8e65c92a0e45cb31)), closes [#23](https://code.podlibre.org/podlibre/castopod/issues/23)
* escape generated feed tag values and remove new lines from public pages meta description ([6238a43](https://code.podlibre.org/podlibre/castopod/commit/6238a43863210afe8988ad7cf251e6bfc6c8557c)), closes [#57](https://code.podlibre.org/podlibre/castopod/issues/57) [#46](https://code.podlibre.org/podlibre/castopod/issues/46)
* fix layout bugs in admin and update translation files ([a834171](https://code.podlibre.org/podlibre/castopod/commit/a83417180cf61cdfadc5509b0aaa2fdb66592be3)), closes [#40](https://code.podlibre.org/podlibre/castopod/issues/40)
* minor corrections ([13be386](https://code.podlibre.org/podlibre/castopod/commit/13be386842e94d9def1f7de4720931d8f6935171))
* move analytics to helper ([d311917](https://code.podlibre.org/podlibre/castopod/commit/d31191732e41aa106234b5ebe6e54ee02f0ce603))
* re-order graph values ([35f633b](https://code.podlibre.org/podlibre/castopod/commit/35f633b4c71c087d1ddc9bba9e9bbe18de09204f))
* remove required for other_categories field and add podcast_id to latest podcasts query ([5417be0](https://code.podlibre.org/podlibre/castopod/commit/5417be0049288489a19c7b575aa77bd1e2bc0243))
* rename issue_templates labels ([9f00305](https://code.podlibre.org/podlibre/castopod/commit/9f00305844e5a168e89d727fe29892b4ad5e48d6))
* rename MyAccount controller file ([e109df3](https://code.podlibre.org/podlibre/castopod/commit/e109df3004a3a98d72de39532e062fff9917f50f)), closes [#60](https://code.podlibre.org/podlibre/castopod/issues/60)
* reorder fields as composite primary keys for analytics tables ([9660aa9](https://code.podlibre.org/podlibre/castopod/commit/9660aa97c8ffd4fe61f3a388d52b9ac5dd8e1d63))
* replace website key for webpages in breadcrumb translate file ([50e32ff](https://code.podlibre.org/podlibre/castopod/commit/50e32ff75636c1d4c5d945a267e884cb26ad7191))
* set episode duration translation to hardcoded english ([c39efc9](https://code.podlibre.org/podlibre/castopod/commit/c39efc9489180662edcebd142d4476c0617ea97f)), closes [#64](https://code.podlibre.org/podlibre/castopod/issues/64)
* set episode guid upon episode creation ([ad8b153](https://code.podlibre.org/podlibre/castopod/commit/ad8b153f2a3b1a3b1751bf63785c4950e1516e6b)), closes [#48](https://code.podlibre.org/podlibre/castopod/issues/48)
* update purgecss content path for php helper files ([eb70bb4](https://code.podlibre.org/podlibre/castopod/commit/eb70bb4f7078ff347aeb8f5dcc7896311d289466)), closes [#59](https://code.podlibre.org/podlibre/castopod/issues/59)
* **install:** redirect to input baseUrl after instance config ([2426af7](https://code.podlibre.org/podlibre/castopod/commit/2426af7de8c9d426aaf534ff17b67f71c2e9f374)), closes [#53](https://code.podlibre.org/podlibre/castopod/issues/53)
* **platforms:** display platform link only when visible is toggled on ([6e503c8](https://code.podlibre.org/podlibre/castopod/commit/6e503c8d6182987e48892370623183f871bbd1c1)), closes [#39](https://code.podlibre.org/podlibre/castopod/issues/39)
* sort episodic podcasts by season ([d7b6794](https://code.podlibre.org/podlibre/castopod/commit/d7b6794f68f9a01fd606a407c6eb4c12d15dee74))
* update .htaccess for shared hosting config ([2379826](https://code.podlibre.org/podlibre/castopod/commit/2379826352e2f4b5060910bf9f29268610102f2e))
* update iso-369 language table seeder ([0c90db4](https://code.podlibre.org/podlibre/castopod/commit/0c90db44c40de5af5b0b32b54489bda9424d9ef6))
* **package.json:** update destination of postcss generation scripts ([21413f8](https://code.podlibre.org/podlibre/castopod/commit/21413f8af3b8a0ac01d8c6f15bcd7a63e524e964))
* use slash instead of backslash to call layout ([a80adb2](https://code.podlibre.org/podlibre/castopod/commit/a80adb22958fc0a38374cbce2d950a0042e699eb))


### Features

* add alternate rss feed link tag to podcast page head ([a973c09](https://code.podlibre.org/podlibre/castopod/commit/a973c097d54a3d0186c4079b9d4d3e81aae38505)), closes [#35](https://code.podlibre.org/podlibre/castopod/issues/35)
* add analytics and unknown useragents ([ec92e65](https://code.podlibre.org/podlibre/castopod/commit/ec92e65aa42e09b1df04600b52a0c679dfc494bb))
* add breadcrumb in admin area ([7fb1de2](https://code.podlibre.org/podlibre/castopod/commit/7fb1de2cf3c97c4cd7afe3bd71bbe66041786ecd)), closes [#17](https://code.podlibre.org/podlibre/castopod/issues/17)
* add french translation ([196920d](https://code.podlibre.org/podlibre/castopod/commit/196920d62f1810b4c35f800d17d7f93627319091))
* add install wizard form to bootstrap database and create the first superadmin user ([cba871c](https://code.podlibre.org/podlibre/castopod/commit/cba871c5df9f7120c44d9952456ebbd0d220669e)), closes [#2](https://code.podlibre.org/podlibre/castopod/issues/2)
* add ISO 3166 country codes ([97cd94b](https://code.podlibre.org/podlibre/castopod/commit/97cd94b47494b66faf43fbbe0748872da80020a4))
* add map analytics, add episodes analytics, clean analytics page layout, translate countries ([07eae83](https://code.podlibre.org/podlibre/castopod/commit/07eae83a00d860e149359fae67d549488403d88b))
* add npm for js dependencies + move src/ files to root folder ([cbb83a6](https://code.podlibre.org/podlibre/castopod/commit/cbb83a6f308ac9357e9fb0cca5edae9d3fee5b48))
* add pages table to store custom instance pages (eg. legal-notice, cookie policy, etc.) ([9c224a8](https://code.podlibre.org/podlibre/castopod/commit/9c224a8ac6dd95f3c6c087a300fc8bac48e8090f)), closes [#24](https://code.podlibre.org/podlibre/castopod/issues/24)
* add platform models ([a333d29](https://code.podlibre.org/podlibre/castopod/commit/a333d291966229a909c0851fd8b890ed97c48ceb))
* add platforms form in podcast settings ([043f49c](https://code.podlibre.org/podlibre/castopod/commit/043f49c784bc007ca0fa756ca4ed2d3b08843ad9))
* add platforms tables ([ce59344](https://code.podlibre.org/podlibre/castopod/commit/ce5934419a516c9926dd3fd0ace3c11a95b60722))
* add unique listeners analytics ([3a49258](https://code.podlibre.org/podlibre/castopod/commit/3a4925816f3268230640525ad7af507aab8eecb9))
* add user permissions and basic groups to handle authorizations ([d58e518](https://code.podlibre.org/podlibre/castopod/commit/d58e51874a4722921b75b0049117015c2380406e)), closes [#3](https://code.podlibre.org/podlibre/castopod/issues/3) [#18](https://code.podlibre.org/podlibre/castopod/issues/18)
* create optimized & resized images upon upload ([02e4441](https://code.podlibre.org/podlibre/castopod/commit/02e4441f98f27e9534e5b9b63279153d14632ccd)), closes [#6](https://code.podlibre.org/podlibre/castopod/issues/6)
* display legal disclaimer and warning on podcast import page ([2f07992](https://code.podlibre.org/podlibre/castopod/commit/2f07992e5508b34b91f194eebfac80c51e80e90a)), closes [#34](https://code.podlibre.org/podlibre/castopod/issues/34)
* edit + delete podcast and episode ([ac5f0c7](https://code.podlibre.org/podlibre/castopod/commit/ac5f0c732806e955c01e05b7867801bc938c6bd5))
* enhance admin ui with responsive design and ux improvements ([2d44b45](https://code.podlibre.org/podlibre/castopod/commit/2d44b457a02205d2e7da258d7029b8bc5da39533)), closes [#31](https://code.podlibre.org/podlibre/castopod/issues/31) [#9](https://code.podlibre.org/podlibre/castopod/issues/9)
* enhance ui using javascript in admin area ([c0e66d5](https://code.podlibre.org/podlibre/castopod/commit/c0e66d5f7012026e145d106f4d6bd3ba792a1b77))
* import podcast from an rss feed url ([9a5d5a1](https://code.podlibre.org/podlibre/castopod/commit/9a5d5a15b4945eb319da9e999c4ca60a0a4f6d2d)), closes [#21](https://code.podlibre.org/podlibre/castopod/issues/21)
* set podcast / episode description in the pages description meta tag ([1c4a504](https://code.podlibre.org/podlibre/castopod/commit/1c4a50442bea2d3449efce9c5ff1c80743152f55)), closes [#44](https://code.podlibre.org/podlibre/castopod/issues/44)
* update analytics so to meet IABv2 requirements ([03e23a2](https://code.podlibre.org/podlibre/castopod/commit/03e23a28bf9b1b73fba55352c36a8cd6cc8ae729)), closes [#10](https://code.podlibre.org/podlibre/castopod/issues/10)
* **cache:** add podcast and episode pages to cache + clear them after insert or update ([da0f047](https://code.podlibre.org/podlibre/castopod/commit/da0f0472819007e02e5da37399f2377772c618b9))
* **categories:** create model, entity, migrations and seeds ([f73b042](https://code.podlibre.org/podlibre/castopod/commit/f73b042cc091be82abdbbca8992080875d526972))
* **devcontainer:** add devcontainer settings for dev environment ([69e7266](https://code.podlibre.org/podlibre/castopod/commit/69e72667365247b63430dee88194e8f0d7c28edc))
* **episodes:** add create form and view pages for episode ([f3b2c8b](https://code.podlibre.org/podlibre/castopod/commit/f3b2c8b84f3d93bef734e34dbe8ed729535e45e9)), closes [#1](https://code.podlibre.org/podlibre/castopod/issues/1)
* **episodes:** add migrations, model and entity for episodes table ([0444821](https://code.podlibre.org/podlibre/castopod/commit/044482174ede555ce19a2d8c6f48771cc8e7d27b))
* **podcast:** create a podcast using form ([1202ba3](https://code.podlibre.org/podlibre/castopod/commit/1202ba3545f521097c60a6a2af95e70527cd1d34))
* **podcast-form:** update routes and redirect to podcast page ([12ce905](https://code.podlibre.org/podlibre/castopod/commit/12ce905799002dc9c07e6de092342d30ba9fd7d8))
* **public-ui:** adapt public podcast and episode pages to wireframes ([40a0535](https://code.podlibre.org/podlibre/castopod/commit/40a0535fc1bc12a24994b651f5e00b35995cbdda)), closes [#30](https://code.podlibre.org/podlibre/castopod/issues/30) [#13](https://code.podlibre.org/podlibre/castopod/issues/13)
* **rss:** generate rss feed from podcast entity ([c815ecd](https://code.podlibre.org/podlibre/castopod/commit/c815ecd6640931fee0895f80908a3ddfac482666))
* **users:** add myth-auth to handle users crud + add admin gateway only accessible by login ([c63a077](https://code.podlibre.org/podlibre/castopod/commit/c63a077618c61b4cde7f25ffc650a4b0e1495f44)), closes [#11](https://code.podlibre.org/podlibre/castopod/issues/11)
* minor corrections to some tables ([3bf9420](https://code.podlibre.org/podlibre/castopod/commit/3bf9420b5956a501b3b24405d243a71a928d6086))
* write id3v2 tags to episode's audio file ([4651d01](https://code.podlibre.org/podlibre/castopod/commit/4651d01a84ff3ea8433a8ae26cfd750a1ec9e88d))


### Reverts

* use basic input file for episodes audio files instead of button for better UX ([d5f22fb](https://code.podlibre.org/podlibre/castopod/commit/d5f22fbb38c43d9b37df401eff655958a57cb40a))
