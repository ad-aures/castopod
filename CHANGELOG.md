# [1.0.0-alpha.76](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.75...v1.0.0-alpha.76) (2021-10-26)

### Bug Fixes

- replace hardcoded style links with vite service + set default value for remote
  transcript url
  ([3f2e056](https://code.podlibre.org/podlibre/castopod-host/commit/3f2e05608e43d47bbb518a9acfaf56ec3eefafb4)),
  closes [#149](https://code.podlibre.org/podlibre/castopod-host/issues/149)
  [#150](https://code.podlibre.org/podlibre/castopod-host/issues/150)

# [1.0.0-alpha.75](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.74...v1.0.0-alpha.75) (2021-10-05)

### Bug Fixes

- **rss:** cast number type values to string in rss_helper
  ([7180ae9](https://code.podlibre.org/podlibre/castopod-host/commit/7180ae9ec700930b69c04ed91f8eceea16ad77ce)),
  closes [#148](https://code.podlibre.org/podlibre/castopod-host/issues/148)

# [1.0.0-alpha.74](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.73...v1.0.0-alpha.74) (2021-09-28)

### Features

- **platforms:** add missing newpodcastapps.com's platforms
  ([92dd370](https://code.podlibre.org/podlibre/castopod-host/commit/92dd370e2f9a464edd26cddcde96d0e16f91548d))

# [1.0.0-alpha.73](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.72...v1.0.0-alpha.73) (2021-09-22)

### Bug Fixes

- **map:** update episode markers query to discard unpublished episodes
  ([b3caac4](https://code.podlibre.org/podlibre/castopod-host/commit/b3caac45b12a23e4289d00133d2ad7915d084c44))

# [1.0.0-alpha.72](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.71...v1.0.0-alpha.72) (2021-09-20)

### Bug Fixes

- rename field status to task_status to get scheduled activities
  ([4ff82a5](https://code.podlibre.org/podlibre/castopod-host/commit/4ff82a5f0a38dbbc9e272fca7df70ea5a190e334))

# [1.0.0-alpha.71](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.70...v1.0.0-alpha.71) (2021-09-17)

### Features

- **map:** display geolocated episodes on a map page
  ([4357cc2](https://code.podlibre.org/podlibre/castopod-host/commit/4357cc25ccc585ce398035c1c25d566b6a9df775))

# [1.0.0-alpha.70](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.69...v1.0.0-alpha.70) (2021-08-31)

### Bug Fixes

- **partner:** set correct image URL
  ([61554be](https://code.podlibre.org/podlibre/castopod-host/commit/61554be12a64d59ab99fab810b1b05632b408f3a))

# [1.0.0-alpha.69](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.68...v1.0.0-alpha.69) (2021-08-23)

### Bug Fixes

- **import:** cast description's SimpleXMLElement to string
  ([02d17be](https://code.podlibre.org/podlibre/castopod-host/commit/02d17be4ffe229fc6657207d31eba0543b5f1a4c))

# [1.0.0-alpha.68](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.67...v1.0.0-alpha.68) (2021-08-19)

### Bug Fixes

- **analytics:** redirect to mp3 file even when referer was not set
  ([9fc388d](https://code.podlibre.org/podlibre/castopod-host/commit/9fc388d154f29c335dedcd624abe8c1751762c07))

# [1.0.0-alpha.67](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.66...v1.0.0-alpha.67) (2021-07-24)

### Features

- allow cross origin requests on episode comments
  ([e12f95a](https://code.podlibre.org/podlibre/castopod-host/commit/e12f95aca13c6d54489a9cfd99d4cd2490fe83ab))

# [1.0.0-alpha.66](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.65...v1.0.0-alpha.66) (2021-07-24)

### Features

- **rss:** add podcast:comments tag to link to episode comments
  ([32e8c7c](https://code.podlibre.org/podlibre/castopod-host/commit/32e8c7c16a61ffe08e2f3bfbdeda556811a0358c))

# [1.0.0-alpha.65](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.64...v1.0.0-alpha.65) (2021-07-22)

### Bug Fixes

- update conditions when checking for empty max_episodes and season_number
  ([fbad0b5](https://code.podlibre.org/podlibre/castopod-host/commit/fbad0b59f68c65eba2fdcd5a8d3b312b622e9a45))

# [1.0.0-alpha.64](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.63...v1.0.0-alpha.64) (2021-07-12)

### Features

- **activitypub:** add Podcast actor and PodcastEpisode object with comments
  ([9e1e5d2](https://code.podlibre.org/podlibre/castopod-host/commit/9e1e5d2e862d6a3345d11ca7f96b955c76bfa013))

# [1.0.0-alpha.63](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.62...v1.0.0-alpha.63) (2021-07-12)

### Features

- build hashed static files to renew browser cache
  ([37c54d2](https://code.podlibre.org/podlibre/castopod-host/commit/37c54d247749bdf8f528babd4a78f24d48051063)),
  closes [#107](https://code.podlibre.org/podlibre/castopod-host/issues/107)

# [1.0.0-alpha.62](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.61...v1.0.0-alpha.62) (2021-07-02)

### Bug Fixes

- **episode:** replace guid's empty string value to null
  ([441052a](https://code.podlibre.org/podlibre/castopod-host/commit/441052af8d99e6e317edefd1e58ad71799357088))

# [1.0.0-alpha.61](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.60...v1.0.0-alpha.61) (2021-06-23)

### Bug Fixes

- **release:** add missing version number to castopod-host package
  ([8f3e9d9](https://code.podlibre.org/podlibre/castopod-host/commit/8f3e9d90c14545d3f84d4469b26a53db4554b4dc))
- **ux:** allow for empty message upon episode publication and warn user on
  submit
  ([33d01b8](https://code.podlibre.org/podlibre/castopod-host/commit/33d01b8d4fd6ebf24e9f011aa705c456c846956c)),
  closes [#129](https://code.podlibre.org/podlibre/castopod-host/issues/129)

# [1.0.0-alpha.60](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.59...v1.0.0-alpha.60) (2021-06-21)

### Features

- **rss:** add ˂podcast:guid˃ tag for channel
  ([1fab10e](https://code.podlibre.org/podlibre/castopod-host/commit/1fab10eb0d63bb7c3edf34ffe691e2aec2c2e43c))

# [1.0.0-alpha.59](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.58...v1.0.0-alpha.59) (2021-06-15)

### Bug Fixes

- check that additional files are valid when creating episode
  ([eac5bc8](https://code.podlibre.org/podlibre/castopod-host/commit/eac5bc876de125e1fe08d1b89f767a04fc0fbfb6))

# [1.0.0-alpha.58](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.57...v1.0.0-alpha.58) (2021-06-11)

### Bug Fixes

- cast actor_id to pass as int to set_interact_as_actor() function
  ([56a8e5d](https://code.podlibre.org/podlibre/castopod-host/commit/56a8e5d7dd615322aeb007e730801c65d0b02e5c))
- **analytics:** set duration field to precise decimal as episode's audio file
  duration
  ([d772685](https://code.podlibre.org/podlibre/castopod-host/commit/d77268540569b2be9d91d5e09aefb3ff5ac2b071))
- **analytics:** update migrations to set decimal precision for latitude and
  longitude
  ([714d6b5](https://code.podlibre.org/podlibre/castopod-host/commit/714d6b5d4950e52cf1c3170bb59954f98ffd48bd))
- check for database connection and podcasts table existence before redirecting
  to install
  ([eb74e81](https://code.podlibre.org/podlibre/castopod-host/commit/eb74e81c3d93581e310b391cd029e62a0d690a8a))
- save transcript and chapters files to podcasts folder
  ([63f49c7](https://code.podlibre.org/podlibre/castopod-host/commit/63f49c719f672b615c5a8893d3868dffcd332e47))
- set cache expiration to next note publish to show note on publication date
  ([0a66de3](https://code.podlibre.org/podlibre/castopod-host/commit/0a66de3e6c17d4ac94ee8e13bd00ceaf64b1303e))
- set episode description footer to null when empty value
  ([3a7d97d](https://code.podlibre.org/podlibre/castopod-host/commit/3a7d97d660046d80698611311ff3708110d2af82))
- set location to null when getting empty string
  ([71b1b5f](https://code.podlibre.org/podlibre/castopod-host/commit/71b1b5f775af475b1dc78328330e277f565e41b6))
- update condition in home controller to redirect to install page
  ([33f1b91](https://code.podlibre.org/podlibre/castopod-host/commit/33f1b91d55dd0652c979d50fc85879dbf88a4a42))
- **activity-pub:** cache issues when navigating to activity stream urls
  ([7bcbfb3](https://code.podlibre.org/podlibre/castopod-host/commit/7bcbfb32f7cca08d111be46c7f1640e372d4a4b0))
- **activity-pub:** get database records using new model instances
  ([92536dd](https://code.podlibre.org/podlibre/castopod-host/commit/92536ddb3812214a9c5682b92e547e5c1998a5d7))
- **category:** remove uncategorized option to enforce users in choosing a
  category
  ([8c64f25](https://code.podlibre.org/podlibre/castopod-host/commit/8c64f25a0e72fec03d25544797d32623b2276fce))
- **install:** redirect manually to install wizard on first visit
  ([2ceaaca](https://code.podlibre.org/podlibre/castopod-host/commit/2ceaaca44f1b82fc64d961e2fb4f4aaeade7e736))
- **types:** update fake seeders types + fix bugs
  ([76a4bf3](https://code.podlibre.org/podlibre/castopod-host/commit/76a4bf344160df679db29e236e7df7822970fb60))
- update broken contributor dropdown fields
  ([e5b7515](https://code.podlibre.org/podlibre/castopod-host/commit/e5b75150234bd7f19e01def93425d3bda7379dd3))
- **ux:** redirect user to install page on database error in home page
  ([9017e30](https://code.podlibre.org/podlibre/castopod-host/commit/9017e30bf41bed8c2be65091bbc5fb1e63aef87a))
- update condition in AnalyticsTrait
  ([fbc0967](https://code.podlibre.org/podlibre/castopod-host/commit/fbc0967caa81630d514ddb1b93b0834ebb4d913b))

### Performance Improvements

- **cache:** use deleteMatching method to prevent forgetting cached elements in
  models
  ([76afc0c](https://code.podlibre.org/podlibre/castopod-host/commit/76afc0cfa2feb087697bae4bc138e4956873dd62))

### Reverts

- set deprecated config options back in App config
  ([433745f](https://code.podlibre.org/podlibre/castopod-host/commit/433745f194c73407999b207090478563283876a5))

# [1.0.0-alpha.57](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.56...v1.0.0-alpha.57) (2021-05-12)

### Bug Fixes

- **follow:** add missing helpers to Actor controller
  ([ee53a73](https://code.podlibre.org/podlibre/castopod-host/commit/ee53a732dc12ebbf5706e14969749a12cfd9d559))

# [1.0.0-alpha.56](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.55...v1.0.0-alpha.56) (2021-05-12)

### Bug Fixes

- **rss:** use originalPath instead of originalMediaPath in Image library
  ([b4012b7](https://code.podlibre.org/podlibre/castopod-host/commit/b4012b7d2ed6b34b69ad767570dd33f0dc7db920))

# [1.0.0-alpha.55](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.54...v1.0.0-alpha.55) (2021-05-03)

### Features

- add remote_url alternative for transcript and chapters files
  ([3143c9a](https://code.podlibre.org/podlibre/castopod-host/commit/3143c9ad36e4cf1364205cf2be39c0c96f80fdd2))

# [1.0.0-alpha.54](https://code.podlibre.org/podlibre/castopod-host/compare/v1.0.0-alpha.53...v1.0.0-alpha.54) (2021-05-03)

### Features

- set app parameter forceGlobalSecureRequests = true forcing requests to go
  through https
  ([d9dff1b](https://code.podlibre.org/podlibre/castopod-host/commit/d9dff1b8bf89c8b526ad6cb89f98a1f160d49117))
- **ux:** remove admin dashboard and redirect directly to podcast list
  ([27c48b8](https://code.podlibre.org/podlibre/castopod-host/commit/27c48b8fa930b33e5e15f0c8685e468e857ca9cd))
- add cache to ActivityPub sql queries + cache activity and note pages
  ([2d297f4](https://code.podlibre.org/podlibre/castopod-host/commit/2d297f45b3d7ef6e8711875a0b9b908e878115fa))

### Performance Improvements

- **cache:** update CI4 to use cache's deleteMatching method
  ([54b84f9](https://code.podlibre.org/podlibre/castopod-host/commit/54b84f96843af13f579fea49102c8c2ef81b0a54))
- **docker:** add redis caching service for development
  ([05ace8c](https://code.podlibre.org/podlibre/castopod-host/commit/05ace8cff2ef02d19abd40097ac5546dca6a54ca))

# [1.0.0-alpha.53](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.52...v1.0.0-alpha.53) (2021-04-16)

### Bug Fixes

- check that note has a preview_card_id before displaying it
  ([acb8b3a](https://code.podlibre.org/podlibre/castopod/commit/acb8b3a40172ccb184ffe544760601d756692e6c)),
  closes [#114](https://code.podlibre.org/podlibre/castopod/issues/114)

# [1.0.0-alpha.52](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.51...v1.0.0-alpha.52) (2021-04-16)

### Bug Fixes

- **avatar:** use default avatar when no avatar url has been set
  ([9d23c7e](https://code.podlibre.org/podlibre/castopod/commit/9d23c7e7e142c6cf1a1418e37e41d711064593c4)),
  closes [#111](https://code.podlibre.org/podlibre/castopod/issues/111)

# [1.0.0-alpha.51](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.50...v1.0.0-alpha.51) (2021-04-15)

### Bug Fixes

- **interact-as:** set actor_id instead of podcast id upon login event
  ([5dfade7](https://code.podlibre.org/podlibre/castopod/commit/5dfade7cf37f339c56d2e577c679b88a1b1d9336)),
  closes [#104](https://code.podlibre.org/podlibre/castopod/issues/104)

# [1.0.0-alpha.50](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.49...v1.0.0-alpha.50) (2021-04-14)

### Bug Fixes

- **persons:** prevent overflow of persons list by adding horizontal scroll
  ([9e8995d](https://code.podlibre.org/podlibre/castopod/commit/9e8995dc6e039032cc65f87895cf770f99e8b244))

# [1.0.0-alpha.49](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.48...v1.0.0-alpha.49) (2021-04-12)

### Bug Fixes

- **multiselect:** add missing class names in choices options for purge to work
  properly
  ([719538d](https://code.podlibre.org/podlibre/castopod/commit/719538d0ccb28af3c3c5e1a4b6468d4b772fe819))

# [1.0.0-alpha.48](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.47...v1.0.0-alpha.48) (2021-04-10)

### Bug Fixes

- **import-with-escaped-characters:** remove \CodeIgniter\HTTP\URI in
  download_file, closes
  [#103](https://code.podlibre.org/podlibre/castopod/issues/103)
  ([35b5be0](https://code.podlibre.org/podlibre/castopod/commit/35b5be095ff54d27acec1610a846ec0cdbdf1d65))

# [1.0.0-alpha.47](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.46...v1.0.0-alpha.47) (2021-04-10)

### Bug Fixes

- **episodeCount:** add missing brackets to French language file
  ([c1b4112](https://code.podlibre.org/podlibre/castopod/commit/c1b411265ad9b06e95a8b097ecf73445b88dcb45))

# [1.0.0-alpha.46](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.45...v1.0.0-alpha.46) (2021-04-09)

### Bug Fixes

- **episodes-page:** handle defaultQuery being null when no podcast episodes
  ([15183b7](https://code.podlibre.org/podlibre/castopod/commit/15183b7eab57dac007bcdfa8c3651239de1ae05a)),
  closes [#100](https://code.podlibre.org/podlibre/castopod/issues/100)

# [1.0.0-alpha.45](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.44...v1.0.0-alpha.45) (2021-04-08)

### Bug Fixes

- add head request to analytics_hit route
  ([f0a2f0b](https://code.podlibre.org/podlibre/castopod/commit/f0a2f0bea491ca91976b351bb79837e95c9d094b))

# [1.0.0-alpha.44](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.43...v1.0.0-alpha.44) (2021-04-08)

### Bug Fixes

- **rss:** set ❬itunes:author❭ tag to owner_name if publisher not specified
  ([2271c14](https://code.podlibre.org/podlibre/castopod/commit/2271c1445b1ded12bc53b5d23b5e59d12b17c71a)),
  closes [#96](https://code.podlibre.org/podlibre/castopod/issues/96)

# [1.0.0-alpha.43](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.42...v1.0.0-alpha.43) (2021-04-08)

### Bug Fixes

- **episode-form:** show warning to set `memory_limit`, `upload_max_filesize` &
  `post_max_size`
  ([3b3c218](https://code.podlibre.org/podlibre/castopod/commit/3b3c218b9c868e9f12c54d7670e69d84c9ee79c0)),
  closes [#5](https://code.podlibre.org/podlibre/castopod/issues/5)
  [#86](https://code.podlibre.org/podlibre/castopod/issues/86)

# [1.0.0-alpha.42](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.41...v1.0.0-alpha.42) (2021-04-02)

### Features

- **fediverse:** implement activitypub protocols + update user interface
  ([2f525c0](https://code.podlibre.org/podlibre/castopod/commit/2f525c0f6e44d320bff16e22c223481923ba683e)),
  closes [#69](https://code.podlibre.org/podlibre/castopod/issues/69)
  [#65](https://code.podlibre.org/podlibre/castopod/issues/65)
  [#85](https://code.podlibre.org/podlibre/castopod/issues/85)
  [#51](https://code.podlibre.org/podlibre/castopod/issues/51)
  [#91](https://code.podlibre.org/podlibre/castopod/issues/91)
  [#92](https://code.podlibre.org/podlibre/castopod/issues/92)
  [#88](https://code.podlibre.org/podlibre/castopod/issues/88)

# [1.0.0-alpha.41](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.40...v1.0.0-alpha.41) (2021-03-30)

### Features

- **partner:** add link and image in episode description
  ([ad07bb9](https://code.podlibre.org/podlibre/castopod/commit/ad07bb9330dc9493813368e969e1f3a3def44614))

# [1.0.0-alpha.40](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.39...v1.0.0-alpha.40) (2021-03-19)

### Features

- **custom-rss:** add custom xml tag injection in rss feed for ❬channel❭ and
  ❬item❭
  ([6ecdaad](https://code.podlibre.org/podlibre/castopod/commit/6ecdaad911d06b7f7a2b7d24710968c7eb9118f6))

# [1.0.0-alpha.39](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.38...v1.0.0-alpha.39) (2021-03-01)

### Bug Fixes

- **embeddable-player:** enable any ancestor when X-Frame-Options is set on
  server
  ([44a4962](https://code.podlibre.org/podlibre/castopod/commit/44a4962e0b7e3ed87e9914b4e7792a0d52330ff8))

# [1.0.0-alpha.38](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.37...v1.0.0-alpha.38) (2021-02-27)

### Features

- **embeddable-player:** add embeddable player widget
  ([141788f](https://code.podlibre.org/podlibre/castopod/commit/141788fa089f9dedc8956c64ca515a4a4625f904))

# [1.0.0-alpha.37](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.36...v1.0.0-alpha.37) (2021-02-17)

### Bug Fixes

- **import:** remove query string from files url
  ([109c4aa](https://code.podlibre.org/podlibre/castopod/commit/109c4aa1afb72dd8b99c0302d74a7fef5a38638e))

# [1.0.0-alpha.36](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.35...v1.0.0-alpha.36) (2021-02-16)

### Features

- **platforms:** add pod.link
  ([3d7a232](https://code.podlibre.org/podlibre/castopod/commit/3d7a2320ddd116e4a311605421126aff57243219))

# [1.0.0-alpha.35](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.34...v1.0.0-alpha.35) (2021-02-12)

### Bug Fixes

- **admin:** save block and lock switches
  ([b66c0af](https://code.podlibre.org/podlibre/castopod/commit/b66c0afc8fab2e338402a9a4f8105e5f5459e208))

# [1.0.0-alpha.34](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.33...v1.0.0-alpha.34) (2021-02-11)

### Bug Fixes

- **rss-import:** add Castopod user-agent, handle redirects for downloaded
  files, add Content namespace
  ([214243b](https://code.podlibre.org/podlibre/castopod/commit/214243b3fec4937e45ef1ceaba1149004cdf3b44))

# [1.0.0-alpha.33](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.32...v1.0.0-alpha.33) (2021-02-10)

### Features

- **platforms:** add helloasso
  ([16cb993](https://code.podlibre.org/podlibre/castopod/commit/16cb993ee6e28987a840fc27a9c2c73794c67697))

# [1.0.0-alpha.32](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.31...v1.0.0-alpha.32) (2021-02-10)

### Features

- **person:** add podcastindex.org namespace person tag
  ([8acd011](https://code.podlibre.org/podlibre/castopod/commit/8acd011f13e99492ef4b44b327685bb006fe5f8f))

# [1.0.0-alpha.31](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.30...v1.0.0-alpha.31) (2020-12-23)

### Features

- **rss:** add podcast:location tag
  ([c0a2282](https://code.podlibre.org/podlibre/castopod/commit/c0a22829bd87d48535a86e60c6cd7280e44683a2))

# [1.0.0-alpha.30](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.29...v1.0.0-alpha.30) (2020-12-21)

### Features

- **rss:** update monetization tag so that it meets PodcastIndex requirements
  ([4c7ecbe](https://code.podlibre.org/podlibre/castopod/commit/4c7ecbee83950e5f9f2482cedaab18a1ac9bfc9e))

# [1.0.0-alpha.29](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.28...v1.0.0-alpha.29) (2020-12-10)

### Bug Fixes

- **episodes:** add publication status + set publication date to null when none
  has been set
  ([d882981](https://code.podlibre.org/podlibre/castopod/commit/d882981b3a86c81921ce6b07d4cf61fc13983689)),
  closes [#70](https://code.podlibre.org/podlibre/castopod/issues/70)

### Reverts

- **soundbites:** remove soundbite table from episode's public page
  ([5dc0f19](https://code.podlibre.org/podlibre/castopod/commit/5dc0f19656de0d764f627d6ae78a9e306c901835))

# [1.0.0-alpha.28](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.27...v1.0.0-alpha.28) (2020-12-07)

### Features

- **rss:** add soundbites according to the podcastindex specs
  ([6b34617](https://code.podlibre.org/podlibre/castopod/commit/6b34617d07c70522cb941e96d91d9987493413eb)),
  closes [#83](https://code.podlibre.org/podlibre/castopod/issues/83)

# [1.0.0-alpha.27](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.26...v1.0.0-alpha.27) (2020-12-07)

### Features

- **platforms:** add AntennaPod
  ([53e9cfd](https://code.podlibre.org/podlibre/castopod/commit/53e9cfd61c794b1539e9d4691d3c4e73c4b7aaa7))

# [1.0.0-alpha.26](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.25...v1.0.0-alpha.26) (2020-11-30)

### Bug Fixes

- **analytics:** update service management so that it works with new OPAWG slug
  values
  ([7fe9d42](https://code.podlibre.org/podlibre/castopod/commit/7fe9d42500ade2c6fa3ff4365b4affc475af0e51))

# [1.0.0-alpha.25](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.24...v1.0.0-alpha.25) (2020-11-30)

### Features

- **platforms:** add podfriend
  ([9fdc8d3](https://code.podlibre.org/podlibre/castopod/commit/9fdc8d32930234c7ffd2be6892be57febcef1086))

# [1.0.0-alpha.24](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.23...v1.0.0-alpha.24) (2020-11-26)

### Features

- **monetization:** add Web Monetization support
  ([96a6026](https://code.podlibre.org/podlibre/castopod/commit/96a6026f1db452085360f5fe248de82a2ec06468))

# [1.0.0-alpha.23](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.22...v1.0.0-alpha.23) (2020-11-24)

### Bug Fixes

- define podcastNamespaceLink value
  ([0d744d2](https://code.podlibre.org/podlibre/castopod/commit/0d744d212df0d070ceea185068eaf2746e1ccd48))

# [1.0.0-alpha.22](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.21...v1.0.0-alpha.22) (2020-11-24)

### Features

- **rss:** add transcript and chapters support
  ([e769d83](https://code.podlibre.org/podlibre/castopod/commit/e769d83a932c169e52a630a17cd4dd8ac5cebaf6)),
  closes [#72](https://code.podlibre.org/podlibre/castopod/issues/72)
  [#82](https://code.podlibre.org/podlibre/castopod/issues/82)

# [1.0.0-alpha.21](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.20...v1.0.0-alpha.21) (2020-11-24)

### Features

- **platforms:** add Fediverse and some funding platforms, add link on logo
  ([afc3d50](https://code.podlibre.org/podlibre/castopod/commit/afc3d50289bb4173e0697d109ffe72f6814b93d1))

# [1.0.0-alpha.20](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.19...v1.0.0-alpha.20) (2020-11-24)

### Bug Fixes

- **import:** use <image><url> tag when no <itunes:image> is present
  ([20e607a](https://code.podlibre.org/podlibre/castopod/commit/20e607afb755bc75056041738fa7cbf6723d754c))

### Features

- **rss:** add podcast-namespace tags for platforms + previousUrl tag
  ([dbba8dc](https://code.podlibre.org/podlibre/castopod/commit/dbba8dc58133967c778514268cbfed8098ed1dbc)),
  closes [#73](https://code.podlibre.org/podlibre/castopod/issues/73)
  [#75](https://code.podlibre.org/podlibre/castopod/issues/75)
  [#76](https://code.podlibre.org/podlibre/castopod/issues/76)
  [#80](https://code.podlibre.org/podlibre/castopod/issues/80)

# [1.0.0-alpha.19](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.18...v1.0.0-alpha.19) (2020-11-13)

### Bug Fixes

- handle HEAD requests on podcast_feed route
  ([74b2640](https://code.podlibre.org/podlibre/castopod/commit/74b2640f2a25c4cd6fd8835fc492c2a6893d4950)),
  closes [#79](https://code.podlibre.org/podlibre/castopod/issues/79)

# [1.0.0-alpha.18](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.17...v1.0.0-alpha.18) (2020-11-09)

### Features

- **platforms:** add Podcast Index
  ([ad52b1c](https://code.podlibre.org/podlibre/castopod/commit/ad52b1cc2b7d0bc844970214d205961a7196b4a9))

# [1.0.0-alpha.17](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.16...v1.0.0-alpha.17) (2020-11-05)

### Bug Fixes

- **open-graph:** replace non existant episode description to podcast
  description in podcast page
  ([b02584e](https://code.podlibre.org/podlibre/castopod/commit/b02584ee609af1ad1b5680cc28208d113eb0410b))

# [1.0.0-alpha.16](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.15...v1.0.0-alpha.16) (2020-11-04)

### Features

- add Open Graph and Twitter meta tags
  ([af970b8](https://code.podlibre.org/podlibre/castopod/commit/af970b8bac949e4c63047e04aca1b7403a4e8deb)),
  closes [#41](https://code.podlibre.org/podlibre/castopod/issues/41)

# [1.0.0-alpha.15](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.14...v1.0.0-alpha.15) (2020-11-03)

### Features

- **analytics:** add 'other' group to pie charts in order to display more
  accurate data
  ([73acef9](https://code.podlibre.org/podlibre/castopod/commit/73acef933ff3485987afc5157de022910876fc12))

# [1.0.0-alpha.14](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.13...v1.0.0-alpha.14) (2020-11-02)

### Features

- **analytics:** add weekday and hour bar charts
  ([8ab3132](https://code.podlibre.org/podlibre/castopod/commit/8ab313296bb4a254ab05e90b17d896039839b784))

# [1.0.0-alpha.13](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.12...v1.0.0-alpha.13) (2020-10-29)

### Bug Fixes

- **episodes-table:** set descriptions to be not null
  ([6774ec1](https://code.podlibre.org/podlibre/castopod/commit/6774ec10fa78527be6b7548ca1dc34ad0ada090c))

### Features

- add episode_numbering() component helper to display episode and season numbers
  ([3f4a6bd](https://code.podlibre.org/podlibre/castopod/commit/3f4a6bd0b9f870f16107a41b102b6bf734868198))
- **episodes:** replace all audio file URL parameters with base64 encoded data
  ([e1f65cd](https://code.podlibre.org/podlibre/castopod/commit/e1f65cd3b53353a30d4ab6eb5312393cf04a1676))

# [1.0.0-alpha.12](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.11...v1.0.0-alpha.12) (2020-10-26)

### Bug Fixes

- replace getWebEnclosureUrl with getEnclosureWebUrl
  ([8122cea](https://code.podlibre.org/podlibre/castopod/commit/8122ceaf8a70050f14b3078f28b024e7d7cdb9ac))

# [1.0.0-alpha.11](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.10...v1.0.0-alpha.11) (2020-10-26)

### Features

- add CDN url
  ([972bcbf](https://code.podlibre.org/podlibre/castopod/commit/972bcbf65ee119b8641ca3c4e5c0e8cf9ca8dd4f)),
  closes [#37](https://code.podlibre.org/podlibre/castopod/issues/37)

# [1.0.0-alpha.10](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.9...v1.0.0-alpha.10) (2020-10-26)

### Bug Fixes

- **install:** redirect to host_url install route on instanceConfig validation
  error
  ([99250b1](https://code.podlibre.org/podlibre/castopod/commit/99250b1868657c249a447399c7ebc69e00d43d1a))

# [1.0.0-alpha.9](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.8...v1.0.0-alpha.9) (2020-10-26)

### Features

- display castopod version in admin footer
  ([9f2574e](https://code.podlibre.org/podlibre/castopod/commit/9f2574e6fbb61dac4e1a4252dff30017685da5f0)),
  closes [#68](https://code.podlibre.org/podlibre/castopod/issues/68)

# [1.0.0-alpha.8](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.7...v1.0.0-alpha.8) (2020-10-22)

### Features

- **episodes:** schedule episode with future publication_date by using cache
  expiration time
  ([4f1e773](https://code.podlibre.org/podlibre/castopod/commit/4f1e773c0f9e4c2597f6c1b0a4773dfb34b2f203)),
  closes [#47](https://code.podlibre.org/podlibre/castopod/issues/47)

# [1.0.0-alpha.7](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.6...v1.0.0-alpha.7) (2020-10-21)

### Features

- **analytics:** add service name from rss user-agent
  ([7202b98](https://code.podlibre.org/podlibre/castopod/commit/7202b9867bd59aafa8c338a4230fb5e5c55b24c6))

### BREAKING CHANGES

- **analytics:** analytics_podcasts_by_player table and analytics_podcasts
  procedure were updated

# [1.0.0-alpha.6](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.5...v1.0.0-alpha.6) (2020-10-20)

### Bug Fixes

- **cache:** add locale for podcast and episode pages + clear some persisting
  cache in models
  ([9cec8a8](https://code.podlibre.org/podlibre/castopod/commit/9cec8a81ccbb7239402fe6633dbc31979272302a)),
  closes [#42](https://code.podlibre.org/podlibre/castopod/issues/42)
  [#61](https://code.podlibre.org/podlibre/castopod/issues/61)

# [1.0.0-alpha.5](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.4...v1.0.0-alpha.5) (2020-10-20)

### Features

- add lock podcast according to the Podcastindex podcast-namespace to prevent
  unauthozized import
  ([72b3012](https://code.podlibre.org/podlibre/castopod/commit/72b301272e0b70ded3e2b237391909e3f152ad0b))

# [1.0.0-alpha.4](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.3...v1.0.0-alpha.4) (2020-10-20)

### Features

- **analytics:** add charts and data export
  ([78625c4](https://code.podlibre.org/podlibre/castopod/commit/78625c471b4f03a09bd42f72b82217e1f2d01cef))

# [1.0.0-alpha.3](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.2...v1.0.0-alpha.3) (2020-10-19)

### Bug Fixes

- **analytics:** remove charts empty values + remove useless language cache
  ([1678794](https://code.podlibre.org/podlibre/castopod/commit/16787941539ba4014281a366789ea896a9cd2afc))

# [1.0.0-alpha.2](https://code.podlibre.org/podlibre/castopod/compare/v1.0.0-alpha.1...v1.0.0-alpha.2) (2020-10-19)

### Features

- add cumulative listening time charts
  ([588b4d2](https://code.podlibre.org/podlibre/castopod/commit/588b4d28da00bc12d02126e23181690f54d81716))

# 1.0.0-alpha.1 (2020-10-16)

### Bug Fixes

- add public/media folder to castopod bundle
  ([8053d35](https://code.podlibre.org/podlibre/castopod/commit/8053d3521b481872711dabaaf265d08b9bfbaa87)),
  closes [#52](https://code.podlibre.org/podlibre/castopod/issues/52)
- add where condition to get episode count without deleted episodes
  ([7661734](https://code.podlibre.org/podlibre/castopod/commit/7661734ed296654630f3668132671117519145dd)),
  closes [#67](https://code.podlibre.org/podlibre/castopod/issues/67)
- comment all cache clean after page update to prevent analytics cache deletion
  ([e6197a4](https://code.podlibre.org/podlibre/castopod/commit/e6197a4972a3cce3d67dd7972bb54f8720b8e5b7))
- correct chart data
  ([4d3e9c8](https://code.podlibre.org/podlibre/castopod/commit/4d3e9c8c02cdc882e9fe1c29625695b6f83c820a))
- correct percona compatibility issue
  ([e53f819](https://code.podlibre.org/podlibre/castopod/commit/e53f819264b2d6902996f11ffcbb7c99295a90ef))
- correct php-fpm issues
  ([1ef55d7](https://code.podlibre.org/podlibre/castopod/commit/1ef55d7315bb44abe05f02ec8a84b6b6a557a9a0))
- correct referrer bug
  ([ed69b2f](https://code.podlibre.org/podlibre/castopod/commit/ed69b2f5004ed1cd18bac824c08a0df01f5d2637))
- correction for servers with low int precision
  ([31b7828](https://code.podlibre.org/podlibre/castopod/commit/31b7828e77519ef43e9bcfcbdf6c21712f97a571))
- declare typed properties in PHPDoc for php<7.4
  ([14dd44d](https://code.podlibre.org/podlibre/castopod/commit/14dd44d03d6db0d9ae4198db8e65c92a0e45cb31)),
  closes [#23](https://code.podlibre.org/podlibre/castopod/issues/23)
- escape generated feed tag values and remove new lines from public pages meta
  description
  ([6238a43](https://code.podlibre.org/podlibre/castopod/commit/6238a43863210afe8988ad7cf251e6bfc6c8557c)),
  closes [#57](https://code.podlibre.org/podlibre/castopod/issues/57)
  [#46](https://code.podlibre.org/podlibre/castopod/issues/46)
- fix layout bugs in admin and update translation files
  ([a834171](https://code.podlibre.org/podlibre/castopod/commit/a83417180cf61cdfadc5509b0aaa2fdb66592be3)),
  closes [#40](https://code.podlibre.org/podlibre/castopod/issues/40)
- minor corrections
  ([13be386](https://code.podlibre.org/podlibre/castopod/commit/13be386842e94d9def1f7de4720931d8f6935171))
- move analytics to helper
  ([d311917](https://code.podlibre.org/podlibre/castopod/commit/d31191732e41aa106234b5ebe6e54ee02f0ce603))
- re-order graph values
  ([35f633b](https://code.podlibre.org/podlibre/castopod/commit/35f633b4c71c087d1ddc9bba9e9bbe18de09204f))
- remove required for other_categories field and add podcast_id to latest
  podcasts query
  ([5417be0](https://code.podlibre.org/podlibre/castopod/commit/5417be0049288489a19c7b575aa77bd1e2bc0243))
- rename issue_templates labels
  ([9f00305](https://code.podlibre.org/podlibre/castopod/commit/9f00305844e5a168e89d727fe29892b4ad5e48d6))
- rename MyAccount controller file
  ([e109df3](https://code.podlibre.org/podlibre/castopod/commit/e109df3004a3a98d72de39532e062fff9917f50f)),
  closes [#60](https://code.podlibre.org/podlibre/castopod/issues/60)
- reorder fields as composite primary keys for analytics tables
  ([9660aa9](https://code.podlibre.org/podlibre/castopod/commit/9660aa97c8ffd4fe61f3a388d52b9ac5dd8e1d63))
- replace website key for webpages in breadcrumb translate file
  ([50e32ff](https://code.podlibre.org/podlibre/castopod/commit/50e32ff75636c1d4c5d945a267e884cb26ad7191))
- set episode duration translation to hardcoded english
  ([c39efc9](https://code.podlibre.org/podlibre/castopod/commit/c39efc9489180662edcebd142d4476c0617ea97f)),
  closes [#64](https://code.podlibre.org/podlibre/castopod/issues/64)
- set episode guid upon episode creation
  ([ad8b153](https://code.podlibre.org/podlibre/castopod/commit/ad8b153f2a3b1a3b1751bf63785c4950e1516e6b)),
  closes [#48](https://code.podlibre.org/podlibre/castopod/issues/48)
- update purgecss content path for php helper files
  ([eb70bb4](https://code.podlibre.org/podlibre/castopod/commit/eb70bb4f7078ff347aeb8f5dcc7896311d289466)),
  closes [#59](https://code.podlibre.org/podlibre/castopod/issues/59)
- **install:** redirect to input baseUrl after instance config
  ([2426af7](https://code.podlibre.org/podlibre/castopod/commit/2426af7de8c9d426aaf534ff17b67f71c2e9f374)),
  closes [#53](https://code.podlibre.org/podlibre/castopod/issues/53)
- **platforms:** display platform link only when visible is toggled on
  ([6e503c8](https://code.podlibre.org/podlibre/castopod/commit/6e503c8d6182987e48892370623183f871bbd1c1)),
  closes [#39](https://code.podlibre.org/podlibre/castopod/issues/39)
- sort episodic podcasts by season
  ([d7b6794](https://code.podlibre.org/podlibre/castopod/commit/d7b6794f68f9a01fd606a407c6eb4c12d15dee74))
- update .htaccess for shared hosting config
  ([2379826](https://code.podlibre.org/podlibre/castopod/commit/2379826352e2f4b5060910bf9f29268610102f2e))
- update iso-369 language table seeder
  ([0c90db4](https://code.podlibre.org/podlibre/castopod/commit/0c90db44c40de5af5b0b32b54489bda9424d9ef6))
- **package.json:** update destination of postcss generation scripts
  ([21413f8](https://code.podlibre.org/podlibre/castopod/commit/21413f8af3b8a0ac01d8c6f15bcd7a63e524e964))
- use slash instead of backslash to call layout
  ([a80adb2](https://code.podlibre.org/podlibre/castopod/commit/a80adb22958fc0a38374cbce2d950a0042e699eb))

### Features

- add alternate rss feed link tag to podcast page head
  ([a973c09](https://code.podlibre.org/podlibre/castopod/commit/a973c097d54a3d0186c4079b9d4d3e81aae38505)),
  closes [#35](https://code.podlibre.org/podlibre/castopod/issues/35)
- add analytics and unknown useragents
  ([ec92e65](https://code.podlibre.org/podlibre/castopod/commit/ec92e65aa42e09b1df04600b52a0c679dfc494bb))
- add breadcrumb in admin area
  ([7fb1de2](https://code.podlibre.org/podlibre/castopod/commit/7fb1de2cf3c97c4cd7afe3bd71bbe66041786ecd)),
  closes [#17](https://code.podlibre.org/podlibre/castopod/issues/17)
- add french translation
  ([196920d](https://code.podlibre.org/podlibre/castopod/commit/196920d62f1810b4c35f800d17d7f93627319091))
- add install wizard form to bootstrap database and create the first superadmin
  user
  ([cba871c](https://code.podlibre.org/podlibre/castopod/commit/cba871c5df9f7120c44d9952456ebbd0d220669e)),
  closes [#2](https://code.podlibre.org/podlibre/castopod/issues/2)
- add ISO 3166 country codes
  ([97cd94b](https://code.podlibre.org/podlibre/castopod/commit/97cd94b47494b66faf43fbbe0748872da80020a4))
- add map analytics, add episodes analytics, clean analytics page layout,
  translate countries
  ([07eae83](https://code.podlibre.org/podlibre/castopod/commit/07eae83a00d860e149359fae67d549488403d88b))
- add npm for js dependencies + move src/ files to root folder
  ([cbb83a6](https://code.podlibre.org/podlibre/castopod/commit/cbb83a6f308ac9357e9fb0cca5edae9d3fee5b48))
- add pages table to store custom instance pages (eg. legal-notice, cookie
  policy, etc.)
  ([9c224a8](https://code.podlibre.org/podlibre/castopod/commit/9c224a8ac6dd95f3c6c087a300fc8bac48e8090f)),
  closes [#24](https://code.podlibre.org/podlibre/castopod/issues/24)
- add platform models
  ([a333d29](https://code.podlibre.org/podlibre/castopod/commit/a333d291966229a909c0851fd8b890ed97c48ceb))
- add platforms form in podcast settings
  ([043f49c](https://code.podlibre.org/podlibre/castopod/commit/043f49c784bc007ca0fa756ca4ed2d3b08843ad9))
- add platforms tables
  ([ce59344](https://code.podlibre.org/podlibre/castopod/commit/ce5934419a516c9926dd3fd0ace3c11a95b60722))
- add unique listeners analytics
  ([3a49258](https://code.podlibre.org/podlibre/castopod/commit/3a4925816f3268230640525ad7af507aab8eecb9))
- add user permissions and basic groups to handle authorizations
  ([d58e518](https://code.podlibre.org/podlibre/castopod/commit/d58e51874a4722921b75b0049117015c2380406e)),
  closes [#3](https://code.podlibre.org/podlibre/castopod/issues/3)
  [#18](https://code.podlibre.org/podlibre/castopod/issues/18)
- create optimized & resized images upon upload
  ([02e4441](https://code.podlibre.org/podlibre/castopod/commit/02e4441f98f27e9534e5b9b63279153d14632ccd)),
  closes [#6](https://code.podlibre.org/podlibre/castopod/issues/6)
- display legal disclaimer and warning on podcast import page
  ([2f07992](https://code.podlibre.org/podlibre/castopod/commit/2f07992e5508b34b91f194eebfac80c51e80e90a)),
  closes [#34](https://code.podlibre.org/podlibre/castopod/issues/34)
- edit + delete podcast and episode
  ([ac5f0c7](https://code.podlibre.org/podlibre/castopod/commit/ac5f0c732806e955c01e05b7867801bc938c6bd5))
- enhance admin ui with responsive design and ux improvements
  ([2d44b45](https://code.podlibre.org/podlibre/castopod/commit/2d44b457a02205d2e7da258d7029b8bc5da39533)),
  closes [#31](https://code.podlibre.org/podlibre/castopod/issues/31)
  [#9](https://code.podlibre.org/podlibre/castopod/issues/9)
- enhance ui using javascript in admin area
  ([c0e66d5](https://code.podlibre.org/podlibre/castopod/commit/c0e66d5f7012026e145d106f4d6bd3ba792a1b77))
- import podcast from an rss feed url
  ([9a5d5a1](https://code.podlibre.org/podlibre/castopod/commit/9a5d5a15b4945eb319da9e999c4ca60a0a4f6d2d)),
  closes [#21](https://code.podlibre.org/podlibre/castopod/issues/21)
- set podcast / episode description in the pages description meta tag
  ([1c4a504](https://code.podlibre.org/podlibre/castopod/commit/1c4a50442bea2d3449efce9c5ff1c80743152f55)),
  closes [#44](https://code.podlibre.org/podlibre/castopod/issues/44)
- update analytics so to meet IABv2 requirements
  ([03e23a2](https://code.podlibre.org/podlibre/castopod/commit/03e23a28bf9b1b73fba55352c36a8cd6cc8ae729)),
  closes [#10](https://code.podlibre.org/podlibre/castopod/issues/10)
- **cache:** add podcast and episode pages to cache + clear them after insert or
  update
  ([da0f047](https://code.podlibre.org/podlibre/castopod/commit/da0f0472819007e02e5da37399f2377772c618b9))
- **categories:** create model, entity, migrations and seeds
  ([f73b042](https://code.podlibre.org/podlibre/castopod/commit/f73b042cc091be82abdbbca8992080875d526972))
- **devcontainer:** add devcontainer settings for dev environment
  ([69e7266](https://code.podlibre.org/podlibre/castopod/commit/69e72667365247b63430dee88194e8f0d7c28edc))
- **episodes:** add create form and view pages for episode
  ([f3b2c8b](https://code.podlibre.org/podlibre/castopod/commit/f3b2c8b84f3d93bef734e34dbe8ed729535e45e9)),
  closes [#1](https://code.podlibre.org/podlibre/castopod/issues/1)
- **episodes:** add migrations, model and entity for episodes table
  ([0444821](https://code.podlibre.org/podlibre/castopod/commit/044482174ede555ce19a2d8c6f48771cc8e7d27b))
- **podcast:** create a podcast using form
  ([1202ba3](https://code.podlibre.org/podlibre/castopod/commit/1202ba3545f521097c60a6a2af95e70527cd1d34))
- **podcast-form:** update routes and redirect to podcast page
  ([12ce905](https://code.podlibre.org/podlibre/castopod/commit/12ce905799002dc9c07e6de092342d30ba9fd7d8))
- **public-ui:** adapt public podcast and episode pages to wireframes
  ([40a0535](https://code.podlibre.org/podlibre/castopod/commit/40a0535fc1bc12a24994b651f5e00b35995cbdda)),
  closes [#30](https://code.podlibre.org/podlibre/castopod/issues/30)
  [#13](https://code.podlibre.org/podlibre/castopod/issues/13)
- **rss:** generate rss feed from podcast entity
  ([c815ecd](https://code.podlibre.org/podlibre/castopod/commit/c815ecd6640931fee0895f80908a3ddfac482666))
- **users:** add myth-auth to handle users crud + add admin gateway only
  accessible by login
  ([c63a077](https://code.podlibre.org/podlibre/castopod/commit/c63a077618c61b4cde7f25ffc650a4b0e1495f44)),
  closes [#11](https://code.podlibre.org/podlibre/castopod/issues/11)
- minor corrections to some tables
  ([3bf9420](https://code.podlibre.org/podlibre/castopod/commit/3bf9420b5956a501b3b24405d243a71a928d6086))
- write id3v2 tags to episode's audio file
  ([4651d01](https://code.podlibre.org/podlibre/castopod/commit/4651d01a84ff3ea8433a8ae26cfd750a1ec9e88d))

### Reverts

- use basic input file for episodes audio files instead of button for better UX
  ([d5f22fb](https://code.podlibre.org/podlibre/castopod/commit/d5f22fbb38c43d9b37df401eff655958a57cb40a))
