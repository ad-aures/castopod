## [1.0.5](https://code.castopod.org/adaures/castopod/compare/v1.0.4...v1.0.5) (2022-11-25)

### Bug Fixes

- **router:** revert to CI4 v4.2.7 to include all routes
  ([c13cfa0](https://code.castopod.org/adaures/castopod/commit/c13cfa0ea0679751521ca4157b953043ecc7974a))

## [1.0.4](https://code.castopod.org/adaures/castopod/compare/v1.0.3...v1.0.4) (2022-11-21)

### Bug Fixes

- update actorUsername regex to get url_to actor
  ([1d6b177](https://code.castopod.org/adaures/castopod/commit/1d6b177a55111ede01fba1c08499036d474533bc))

## [1.0.3](https://code.castopod.org/adaures/castopod/compare/v1.0.2...v1.0.3) (2022-11-17)

### Bug Fixes

- **dashboard-ui:** fill the blank gaps between cards on smaller screen sizes
  ([00836cc](https://code.castopod.org/adaures/castopod/commit/00836cc368c75ae2e23fa5dc4a53a5bb6eb2ce24))

## [1.0.2](https://code.castopod.org/adaures/castopod/compare/v1.0.1...v1.0.2) (2022-11-04)

### Bug Fixes

- **auth:** disallow registration by default
  ([379b9be](https://code.castopod.org/adaures/castopod/commit/379b9be2b99574fe4af4009b01128dba2c75f037))
- **contributors:** add prefix to podcast group to delete contributor
  ([9f785db](https://code.castopod.org/adaures/castopod/commit/9f785db7ba674638a6f456aa3626f3f8100911f1))
- extract podcast ids from user groups using a regex
  ([e26215a](https://code.castopod.org/adaures/castopod/commit/e26215a11fc23aa0ad5ccff8ee97d6c6e8a09c1a))
- **notifications:** add manage-notifications permission to podcast
  ([ed7c247](https://code.castopod.org/adaures/castopod/commit/ed7c247bcbbb450e5ff96418930d3b37ce912cc4))
- **platforms:** convert special characters to htmlentities to validate url
  ([82310a2](https://code.castopod.org/adaures/castopod/commit/82310a2e0b426e84501090bdd9c0cf592d1c0d53))

## [1.0.1](https://code.castopod.org/adaures/castopod/compare/v1.0.0...v1.0.1) (2022-11-01)

### Bug Fixes

- **platforms:** trim platform url before validation and storage
  ([259fe5f](https://code.castopod.org/adaures/castopod/commit/259fe5f697a833e268cde88e959bc19bd662edf6))

# 1.0.0 (2022-10-20)

### Bug Fixes

- **a11y:** replace active tab color to contrast with background on podcast and
  episode pages
  ([f3785e1](https://code.castopod.org/adaures/castopod/commit/f3785e140147d085a2fb6a62ded87cdfe360f442))
- **activity-pub:** cache issues when navigating to activity stream urls
  ([7bcbfb3](https://code.castopod.org/adaures/castopod/commit/7bcbfb32f7cca08d111be46c7f1640e372d4a4b0))
- **activity-pub:** get database records using new model instances
  ([92536dd](https://code.castopod.org/adaures/castopod/commit/92536ddb3812214a9c5682b92e547e5c1998a5d7))
- **activitypub:** add conditions for possibly missing actor properties + add
  user-agent to requests
  ([8fbf948](https://code.castopod.org/adaures/castopod/commit/8fbf948fbba22ffd33966a1b2ccd42e8f7c1f8a2))
- **activitypub:** add target actor id to like / announce activities to send
  directly to note's actor
  ([962dd30](https://code.castopod.org/adaures/castopod/commit/962dd305f5d3f6eadc68f400e0e8f953827fe20d))
- **activitypub:** add target_actor_id for create activity to broadcast post
  reply
  ([0128a21](https://code.castopod.org/adaures/castopod/commit/0128a21ec55dcc0a2fbf4081dadb4c4737735ba1))
- **activitypub:** allow cors on get requests for routes exposing activitypub
  objects
  ([2f24809](https://code.castopod.org/adaures/castopod/commit/2f2480998f9abb34f02ab186c65d462a74b4e640))
- **activitypub:** set created_by to null for reblog if no user + update episode
  oembed data
  ([209dfbd](https://code.castopod.org/adaures/castopod/commit/209dfbd134e1a2cc02e7c24c158d786fa4dda61d))
- add admin-audio-player to vite config to have admin player show up
  ([93cb9b2](https://code.castopod.org/adaures/castopod/commit/93cb9b24701c09b92820204a67c1fc1b3c044708))
- add application/octet-stream mimetype to mp3 and m4a extensions to prevent
  ext_in error
  ([339bef8](https://code.castopod.org/adaures/castopod/commit/339bef878e54983d86e91e6ff7a931a843d321b3)),
  closes [#145](https://code.castopod.org/adaures/castopod/issues/145)
- add category_label component to include parent category in about podcast page
  ([74e7d68](https://code.castopod.org/adaures/castopod/commit/74e7d68ac834885c4b89ee6e7d60db2157165799))
- add explicit int conversion when formatting episode duration
  ([1253096](https://code.castopod.org/adaures/castopod/commit/1253096197a0d30692bdafa7152f250cd9a71acf))
- add head request to analytics_hit route
  ([f0a2f0b](https://code.castopod.org/adaures/castopod/commit/f0a2f0bea491ca91976b351bb79837e95c9d094b))
- add href to castopod website on login page
  ([cc54257](https://code.castopod.org/adaures/castopod/commit/cc5425735184ad738aa0f38540f18e8971f8f56e))
- add missing explicit badge for podcasts and episodes
  ([cdf9f9d](https://code.castopod.org/adaures/castopod/commit/cdf9f9d53f2597f19455cb65c51da4677bb99327))
- add open graph size for podcast images to replace the inadequate large format
  ([33aae1f](https://code.castopod.org/adaures/castopod/commit/33aae1f7934e4962116e94e477dbf48e24971f5f))
- add public/media folder to castopod bundle
  ([8053d35](https://code.castopod.org/adaures/castopod/commit/8053d3521b481872711dabaaf265d08b9bfbaa87)),
  closes [#52](https://code.castopod.org/adaures/castopod/issues/52)
- add translation key for audio-clipper trim labels
  ([db191ac](https://code.castopod.org/adaures/castopod/commit/db191ac31bd16bad2a72afdb8b25c685adf86a6e))
- add underline and semibold font weight for prose links to have them stand out
  ([d4d8671](https://code.castopod.org/adaures/castopod/commit/d4d867121c50bded4176a53d7154cf1bb347e306))
- add where condition to get episode count without deleted episodes
  ([7661734](https://code.castopod.org/adaures/castopod/commit/7661734ed296654630f3668132671117519145dd)),
  closes [#67](https://code.castopod.org/adaures/castopod/issues/67)
- **admin:** save block and lock switches
  ([b66c0af](https://code.castopod.org/adaures/castopod/commit/b66c0afc8fab2e338402a9a4f8105e5f5459e208))
- **analytics:** redirect to mp3 file even when referer was not set
  ([9fc388d](https://code.castopod.org/adaures/castopod/commit/9fc388d154f29c335dedcd624abe8c1751762c07))
- **analytics:** remove charts empty values + remove useless language cache
  ([1678794](https://code.castopod.org/adaures/castopod/commit/16787941539ba4014281a366789ea896a9cd2afc))
- **analytics:** set duration field to precise decimal as episode's audio file
  duration
  ([d772685](https://code.castopod.org/adaures/castopod/commit/d77268540569b2be9d91d5e09aefb3ff5ac2b071))
- **analytics:** set initial value for duration and bandwidth
  ([ee50539](https://code.castopod.org/adaures/castopod/commit/ee5053959154b1a2e5fbe4b43162968425206a26))
- **analytics:** update migrations to set decimal precision for latitude and
  longitude
  ([714d6b5](https://code.castopod.org/adaures/castopod/commit/714d6b5d4950e52cf1c3170bb59954f98ffd48bd))
- **analytics:** update service management so that it works with new OPAWG slug
  values
  ([7fe9d42](https://code.castopod.org/adaures/castopod/commit/7fe9d42500ade2c6fa3ff4365b4affc475af0e51))
- **audio-clipper:** add mouse position offset when stretching clip to prevent
  content from jumping
  ([602654b](https://code.castopod.org/adaures/castopod/commit/602654b99b33ee8c29da080058a0aaea976cd484))
- **audio-clipper:** show audio playing progress + put waveform behind audio
  clipper
  ([01a09dc](https://code.castopod.org/adaures/castopod/commit/01a09dc447b81c5412ceb45d6706a867939fd4dd))
- **avatar:** use default avatar when no avatar url has been set
  ([9d23c7e](https://code.castopod.org/adaures/castopod/commit/9d23c7e7e142c6cf1a1418e37e41d711064593c4)),
  closes [#111](https://code.castopod.org/adaures/castopod/issues/111)
- **bundle:** include modules and themes when copying files with rsync
  ([cd5bb88](https://code.castopod.org/adaures/castopod/commit/cd5bb8835c6e259408a8c13a2196a347e161da83))
- **bundle:** update vite input files path + add `set -e` in bash scripts to
  fail if command fails
  ([0ee53c7](https://code.castopod.org/adaures/castopod/commit/0ee53c71ffadb8a6ddb1febd9f912bc99f5f7a0b))
- **cache:** add locale for podcast and episode pages + clear some persisting
  cache in models
  ([9cec8a8](https://code.castopod.org/adaures/castopod/commit/9cec8a81ccbb7239402fe6633dbc31979272302a)),
  closes [#42](https://code.castopod.org/adaures/castopod/issues/42)
  [#61](https://code.castopod.org/adaures/castopod/issues/61)
- **cache:** delete posts and comments pages cache when updating platform links
  ([f7c3e5b](https://code.castopod.org/adaures/castopod/commit/f7c3e5bf4ad43389bf8d58d2c4aaf16b81cbce00)),
  closes [#169](https://code.castopod.org/adaures/castopod/issues/169)
- **cache:** return a non cached view when connected
  ([e2e7358](https://code.castopod.org/adaures/castopod/commit/e2e735815d805a48eed2ea3288d060d0ddb253a3))
- **cache:** suffix cache names with authenticated for credits, map and pages
  ([418a70b](https://code.castopod.org/adaures/castopod/commit/418a70b2a670d8ba0ab6c15fa5faa41f6be55e53))
- cast actor_id to pass as int to set_interact_as_actor() function
  ([56a8e5d](https://code.castopod.org/adaures/castopod/commit/56a8e5d7dd615322aeb007e730801c65d0b02e5c))
- **category:** remove uncategorized option to enforce users in choosing a
  category
  ([8c64f25](https://code.castopod.org/adaures/castopod/commit/8c64f25a0e72fec03d25544797d32623b2276fce))
- change image size requirement hints
  ([ea20206](https://code.castopod.org/adaures/castopod/commit/ea20206ee674eb54dd3ea188d2a2e2d41425df65))
- change message upon cancellation of episode publication
  ([9859c74](https://code.castopod.org/adaures/castopod/commit/9859c7434c2a3478ce035f7a4de20f594d63f5b0))
- check for database connection and podcasts table existence before redirecting
  to install
  ([eb74e81](https://code.castopod.org/adaures/castopod/commit/eb74e81c3d93581e310b391cd029e62a0d690a8a))
- check that additional files are valid when creating episode
  ([eac5bc8](https://code.castopod.org/adaures/castopod/commit/eac5bc876de125e1fe08d1b89f767a04fc0fbfb6))
- check that note has a preview_card_id before displaying it
  ([acb8b3a](https://code.castopod.org/adaures/castopod/commit/acb8b3a40172ccb184ffe544760601d756692e6c)),
  closes [#114](https://code.castopod.org/adaures/castopod/issues/114)
- clear cache when deleting podcast banner
  ([99bb40b](https://code.castopod.org/adaures/castopod/commit/99bb40b8bc17b8ee2cd8468a82e46ea280c92cb6))
- comment all cache clean after page update to prevent analytics cache deletion
  ([e6197a4](https://code.castopod.org/adaures/castopod/commit/e6197a4972a3cce3d67dd7972bb54f8720b8e5b7))
- **comments:** add comment view partials for public pages
  ([fcecbe1](https://code.castopod.org/adaures/castopod/commit/fcecbe1c68b0d28d19454fba65caf3ab769fbc75))
- correct chart data
  ([4d3e9c8](https://code.castopod.org/adaures/castopod/commit/4d3e9c8c02cdc882e9fe1c29625695b6f83c820a))
- correct percona compatibility issue
  ([e53f819](https://code.castopod.org/adaures/castopod/commit/e53f819264b2d6902996f11ffcbb7c99295a90ef))
- correct php-fpm issues
  ([1ef55d7](https://code.castopod.org/adaures/castopod/commit/1ef55d7315bb44abe05f02ec8a84b6b6a557a9a0))
- correct referrer bug
  ([ed69b2f](https://code.castopod.org/adaures/castopod/commit/ed69b2f5004ed1cd18bac824c08a0df01f5d2637))
- correction for servers with low int precision
  ([31b7828](https://code.castopod.org/adaures/castopod/commit/31b7828e77519ef43e9bcfcbdf6c21712f97a571))
- **cors:** add preflight option routes for episode, podcast and status objects
  ([a281abf](https://code.castopod.org/adaures/castopod/commit/a281abfda475388a07943c169dab460cc2d4f944))
- declare typed properties in PHPDoc for php<7.4
  ([14dd44d](https://code.castopod.org/adaures/castopod/commit/14dd44d03d6db0d9ae4198db8e65c92a0e45cb31)),
  closes [#23](https://code.castopod.org/adaures/castopod/issues/23)
- define podcast_id and platform_slug as foreign keys in podcasts_platforms table
  ([6e9451a](https://code.castopod.org/adaures/castopod/commit/6e9451a1103b43750fa70ad576de36af25ca29cb))
- define podcastNamespaceLink value
  ([0d744d2](https://code.castopod.org/adaures/castopod/commit/0d744d212df0d070ceea185068eaf2746e1ccd48))
- **email:** set the correct url in the activation and forgot emails
  ([10fc6f1](https://code.castopod.org/adaures/castopod/commit/10fc6f17c6838a58348f32ccfd0cf05f9d3e172c)),
  closes [#204](https://code.castopod.org/adaures/castopod/issues/204)
- **embeddable-player:** enable any ancestor when X-Frame-Options is set on
  server
  ([44a4962](https://code.castopod.org/adaures/castopod/commit/44a4962e0b7e3ed87e9914b4e7792a0d52330ff8))
- **embed:** open embedded player's links in new tab
  ([4aa73d7](https://code.castopod.org/adaures/castopod/commit/4aa73d71e3b8c0a6c3f75f4d1d45c4d693aba64c))
- **episode-form:** show warning to set `memory_limit`, `upload_max_filesize` &
  `post_max_size`
  ([3b3c218](https://code.castopod.org/adaures/castopod/commit/3b3c218b9c868e9f12c54d7670e69d84c9ee79c0)),
  closes [#5](https://code.castopod.org/adaures/castopod/issues/5)
  [#86](https://code.castopod.org/adaures/castopod/issues/86)
- **episode-unpublish:** set consistent posts_counts' increments/decrements for
  actors and episodes
  ([8acdafd](https://code.castopod.org/adaures/castopod/commit/8acdafd26044e50a4d6ee451bf24ad66003c5bb3)),
  closes [#233](https://code.castopod.org/adaures/castopod/issues/233)
- **episodeCount:** add missing brackets to French language file
  ([c1b4112](https://code.castopod.org/adaures/castopod/commit/c1b411265ad9b06e95a8b097ecf73445b88dcb45))
- **episode:** replace guid's empty string value to null
  ([441052a](https://code.castopod.org/adaures/castopod/commit/441052af8d99e6e317edefd1e58ad71799357088))
- **episodes-page:** handle defaultQuery being null when no podcast episodes
  ([15183b7](https://code.castopod.org/adaures/castopod/commit/15183b7eab57dac007bcdfa8c3651239de1ae05a)),
  closes [#100](https://code.castopod.org/adaures/castopod/issues/100)
- **episodes-table:** set descriptions to be not null
  ([6774ec1](https://code.castopod.org/adaures/castopod/commit/6774ec10fa78527be6b7548ca1dc34ad0ada090c))
- **episodes:** add publication status + set publication date to null when none
  has been set
  ([d882981](https://code.castopod.org/adaures/castopod/commit/d882981b3a86c81921ce6b07d4cf61fc13983689)),
  closes [#70](https://code.castopod.org/adaures/castopod/issues/70)
- escape characters for `min` in format_duration_symbol
  ([3b6722a](https://code.castopod.org/adaures/castopod/commit/3b6722a42b9e4330e5235d4ceed41c777159f4dc))
- escape generated feed tag values and remove new lines from public pages meta
  description
  ([6238a43](https://code.castopod.org/adaures/castopod/commit/6238a43863210afe8988ad7cf251e6bfc6c8557c)),
  closes [#57](https://code.castopod.org/adaures/castopod/issues/57)
  [#46](https://code.castopod.org/adaures/castopod/issues/46)
- expire default query cache upon scheduled episode publication
  ([b72e7c8](https://code.castopod.org/adaures/castopod/commit/b72e7c8691c887e41107baea0a4d50a39eaf8c8b)),
  closes [#81](https://code.castopod.org/adaures/castopod/issues/81)
- explicitly cast seconds to int in iso8601_duration helper function
  ([779653f](https://code.castopod.org/adaures/castopod/commit/779653f75b140942f731cbb238bc0667cc461307))
- **fediverse:** set default castopod avatar url when actor avatar is not
  present
  ([460f52f](https://code.castopod.org/adaures/castopod/commit/460f52f70e493d619c28632db6c698e88f0ebb5f))
- **fediverse:** set model instances as non shared to prevent overlapping
  ([91128fa](https://code.castopod.org/adaures/castopod/commit/91128fad7a68e1f4e5acacba90b6899288699e61))
- fix layout bugs in admin and update translation files
  ([a834171](https://code.castopod.org/adaures/castopod/commit/a83417180cf61cdfadc5509b0aaa2fdb66592be3)),
  closes [#40](https://code.castopod.org/adaures/castopod/issues/40)
- **follow:** add missing helpers to Actor controller
  ([ee53a73](https://code.castopod.org/adaures/castopod/commit/ee53a732dc12ebbf5706e14969749a12cfd9d559))
- **get_browser_language:** return defaultLocale if browser doesn't send user
  preferred language
  ([9cc2996](https://code.castopod.org/adaures/castopod/commit/9cc299626181048b85b629bbe7f5806a1f5d21ff))
- handle HEAD requests on podcast_feed route
  ([74b2640](https://code.castopod.org/adaures/castopod/commit/74b2640f2a25c4cd6fd8835fc492c2a6893d4950)),
  closes [#79](https://code.castopod.org/adaures/castopod/issues/79)
- **home:** remove hardcoded prefix in getAllPodcasts query
  ([92d5cc5](https://code.castopod.org/adaures/castopod/commit/92d5cc50a3e533875cd894dccc417918102d4b7f))
- **housekeeping:** replace the use of GLOB_BRACE with looping over file
  extensions
  ([42d92d0](https://code.castopod.org/adaures/castopod/commit/42d92d0c8dfe0c567c28f5bfdda129890fa4c2ec)),
  closes [#154](https://code.castopod.org/adaures/castopod/issues/154)
- **housekeeping:** set default sizes value + ignore illegal IFD size error to
  proceed with script
  ([f21ca57](https://code.castopod.org/adaures/castopod/commit/f21ca57603cfa503699b7e09a155e18d876d65fe))
- **housekeeping:** use EpisodeModel's builder to reset comments count
  ([65e9c0b](https://code.castopod.org/adaures/castopod/commit/65e9c0b05ea4992884149cb4a4b071bf31a20a1a))
- **htaccess:** add ? after index.php in RewriteRule
  ([d9d139e](https://code.castopod.org/adaures/castopod/commit/d9d139eefa03c28d1a064b3b32c9036193497e57)),
  closes [#152](https://code.castopod.org/adaures/castopod/issues/152)
- **http-signature:** update SIGNATURE_PATTERN allowing signature keys to be
  sent in any order
  ([b7f285e](https://code.castopod.org/adaures/castopod/commit/b7f285e4e24247fedb94f030356fa6f291f525cc))
- **images:** set default mimetype if none is specified when getting size info
  ([6e4acc6](https://code.castopod.org/adaures/castopod/commit/6e4acc64ad256178cee7905402b48bafcd49f84c))
- **import-with-escaped-characters:** remove \CodeIgniter\HTTP\URI in
  download_file, closes
  [#103](https://code.castopod.org/adaures/castopod/issues/103)
  ([35b5be0](https://code.castopod.org/adaures/castopod/commit/35b5be095ff54d27acec1610a846ec0cdbdf1d65))
- **import:** add extension when downloading file without + truncate slug if too
  long
  ([c5f18bb](https://code.castopod.org/adaures/castopod/commit/c5f18bb6dc08a758ff735454bbe9cfa45a68c09b))
- **import:** add validation for handle field to prevent
  Router.invalidParameterType error
  ([5bf7200](https://code.castopod.org/adaures/castopod/commit/5bf7200fb390f2447b29f24b495f24483cf7b205)),
  closes [#119](https://code.castopod.org/adaures/castopod/issues/119)
- **import:** cast description's SimpleXMLElement to string
  ([02d17be](https://code.castopod.org/adaures/castopod/commit/02d17be4ffe229fc6657207d31eba0543b5f1a4c))
- **import:** remove query string from files url
  ([109c4aa](https://code.castopod.org/adaures/castopod/commit/109c4aa1afb72dd8b99c0302d74a7fef5a38638e))
- **import:** save media files during podcast import + set missing media fields
  ([a9989d8](https://code.castopod.org/adaures/castopod/commit/a9989d841a634f8cf6c04df25f40bb1e7d4fcdcc))
- **import:** set default episode type if not set
  ([d7250ab](https://code.castopod.org/adaures/castopod/commit/d7250ab03f9b032830c575ad58b51c8d60b7a49a))
- **import:** set episode and season numbers to null when not present in item
  tag
  ([3211398](https://code.castopod.org/adaures/castopod/commit/3211398c78b1b28b76a46427ee07874bbf84a85d))
- **import:** use <image><url> tag when no <itunes:image> is present
  ([20e607a](https://code.castopod.org/adaures/castopod/commit/20e607afb755bc75056041738fa7cbf6723d754c))
- include missing variables on public ui's episode page and remote_actions
  ([193b373](https://code.castopod.org/adaures/castopod/commit/193b373bc94a5270acae99b637aa84b6cb2dedfe))
- **input-component:** unset required attribute to prevent rendering it when
  false
  ([db9ac13](https://code.castopod.org/adaures/castopod/commit/db9ac13860bce58235a5da275910bea605a00626))
- **install:** add password validation when creating super admin
  ([5a2ca0c](https://code.castopod.org/adaures/castopod/commit/5a2ca0cc4ae85cc15960201c86f131cb822f714f))
- **install:** redirect manually to install wizard on first visit
  ([2ceaaca](https://code.castopod.org/adaures/castopod/commit/2ceaaca44f1b82fc64d961e2fb4f4aaeade7e736))
- **install:** redirect to host_url install route on instanceConfig validation
  error
  ([99250b1](https://code.castopod.org/adaures/castopod/commit/99250b1868657c249a447399c7ebc69e00d43d1a))
- **install:** redirect to input baseUrl after instance config
  ([2426af7](https://code.castopod.org/adaures/castopod/commit/2426af7de8c9d426aaf534ff17b67f71c2e9f374)),
  closes [#53](https://code.castopod.org/adaures/castopod/issues/53)
- **install:** set message block on forms to show error messages
  ([3a0a20d](https://code.castopod.org/adaures/castopod/commit/3a0a20d59cdae7f166325efb750eaa6e9800ba6e)),
  closes [#157](https://code.castopod.org/adaures/castopod/issues/157)
- **interact-as:** set actor_id instead of podcast id upon login event
  ([5dfade7](https://code.castopod.org/adaures/castopod/commit/5dfade7cf37f339c56d2e577c679b88a1b1d9336)),
  closes [#104](https://code.castopod.org/adaures/castopod/issues/104)
- **json-ld:** add missing properties to PodcastSeries object
  ([e97266c](https://code.castopod.org/adaures/castopod/commit/e97266c5d4883a10f68b3685ecc0d1942f54d658))
- keep subtitle line breaks when parsing srt file to json
  ([cfb3da6](https://code.castopod.org/adaures/castopod/commit/cfb3da6592f2de23cb1a7ac420f19fc77fa338aa))
- **layouts:** replace holy-grail layout with tailwind config + widen public
  podcast layout
  ([be5a287](https://code.castopod.org/adaures/castopod/commit/be5a28787fdb180b64d9bf570120eff7072ab9aa))
- **map:** update episode markers query to discard unpublished episodes
  ([b3caac4](https://code.castopod.org/adaures/castopod/commit/b3caac45b12a23e4289d00133d2ad7915d084c44))
- **markdown-editor:** remove unnecessary buttons for podcast and episode
  editors + add extensions
  ([9c4f60e](https://code.castopod.org/adaures/castopod/commit/9c4f60e00bcbd4f784f12d2a6fed357ad402ee2e))
- **md-editor:** build new markdown editor with lit +
  github/markdown-toolbar-element
  ([9ec1cb9](https://code.castopod.org/adaures/castopod/commit/9ec1cb93da6f41124c48b8cf14ee6942e865bede)),
  closes [#93](https://code.castopod.org/adaures/castopod/issues/93)
  [#94](https://code.castopod.org/adaures/castopod/issues/94)
  [#120](https://code.castopod.org/adaures/castopod/issues/120)
- **migrations:** ignore invalid utf8 chars for media files metadata + update
  transcript parser
  ([45e8f99](https://code.castopod.org/adaures/castopod/commit/45e8f99e753cc02ec105e6f4d7fe026a205724f8))
- minor corrections
  ([13be386](https://code.castopod.org/adaures/castopod/commit/13be386842e94d9def1f7de4720931d8f6935171))
- move analytics to helper
  ([d311917](https://code.castopod.org/adaures/castopod/commit/d31191732e41aa106234b5ebe6e54ee02f0ce603))
- move html escaping on credits page
  ([fbffdbd](https://code.castopod.org/adaures/castopod/commit/fbffdbde78544c83138ee6234c62d43056f407b6))
- **multiselect:** add missing class names in choices options for purge to work
  properly
  ([719538d](https://code.castopod.org/adaures/castopod/commit/719538d0ccb28af3c3c5e1a4b6468d4b772fe819))
- **notifications:** add trigger after activities update + update insert trigger
  ([e5d16e8](https://code.castopod.org/adaures/castopod/commit/e5d16e87119021fa5a43470d67ddfe5128e57f74))
- **notifications:** notify actors after activities insert / update using model
  callback methods
  ([e08555a](https://code.castopod.org/adaures/castopod/commit/e08555a4e9a6c15eeba18273c63403f82eddae35))
- **open-graph:** replace non existant episode description to podcast
  description in podcast page
  ([b02584e](https://code.castopod.org/adaures/castopod/commit/b02584ee609af1ad1b5680cc28208d113eb0410b))
- overwrite common lang function to escape returned string
  ([4c490c1](https://code.castopod.org/adaures/castopod/commit/4c490c15bb6642ad0b2aaddf08d8af25de99b4b0)),
  closes [#196](https://code.castopod.org/adaures/castopod/issues/196)
  [#198](https://code.castopod.org/adaures/castopod/issues/198)
- overwrite getActorById to return app's Actor entity
  ([f2bc2f7](https://code.castopod.org/adaures/castopod/commit/f2bc2f7e01aa166faa627df6fe4d5ed4887c16e5))
- **package.json:** update destination of postcss generation scripts
  ([21413f8](https://code.castopod.org/adaures/castopod/commit/21413f8af3b8a0ac01d8c6f15bcd7a63e524e964))
- **pages:** add locale to page cache
  ([8f999ce](https://code.castopod.org/adaures/castopod/commit/8f999ce2f7ee1416c30cf58c84f67b3d11b3f142))
- **partner:** set correct image URL
  ([61554be](https://code.castopod.org/adaures/castopod/commit/61554be12a64d59ab99fab810b1b05632b408f3a))
- pass timezone to relative time component to show the localized time in the UI
  ([b9db936](https://code.castopod.org/adaures/castopod/commit/b9db936461d4cb914958bb3256bb910bbd7ba815))
- **persons:** prevent overflow of persons list by adding horizontal scroll
  ([9e8995d](https://code.castopod.org/adaures/castopod/commit/9e8995dc6e039032cc65f87895cf770f99e8b244))
- **persons:** set person picture as optional for better ux
  ([7fdea63](https://code.castopod.org/adaures/castopod/commit/7fdea63de7e572810082c84fff3013af580df58b)),
  closes [#125](https://code.castopod.org/adaures/castopod/issues/125)
- **platforms:** display platform link only when visible is toggled on
  ([6e503c8](https://code.castopod.org/adaures/castopod/commit/6e503c8d6182987e48892370623183f871bbd1c1)),
  closes [#39](https://code.castopod.org/adaures/castopod/issues/39)
- **player-styling:** revert vite to 2.8 to reference the player css
  ([e07d3af](https://code.castopod.org/adaures/castopod/commit/e07d3afea9af85b8361227e000fb64b502781668))
- **podcast-activity:** check if transcript and chapters are set before
  including them in audio
  ([5855a25](https://code.castopod.org/adaures/castopod/commit/5855a250936f91641efef77650890a18d8e9917f))
- **podcast-import:** move guid attribute declaration for Episode entity to
  include slug data
  ([5d02ae3](https://code.castopod.org/adaures/castopod/commit/5d02ae39908a9d743627135b372bf981134c4328))
- **podcast:** use markdown description value for editor + set prose class to
  about description
  ([f304d97](https://code.castopod.org/adaures/castopod/commit/f304d97b14e0ef383509cb3bba50beb55bf701ba)),
  closes [#156](https://code.castopod.org/adaures/castopod/issues/156)
- prefill description footer input when creating a new episode
  ([9ea5ca3](https://code.castopod.org/adaures/castopod/commit/9ea5ca31697c70d176294f8aea37bd57d471fcf7))
- **premium-podcasts:** display unlock button in embed when premium episode
  ([ca109ba](https://code.castopod.org/adaures/castopod/commit/ca109ba3a8a08e661fd2484454b1983c3418f15d))
- **premium-podcasts:** remove cache in unlock form + redirect to podcast if
  podcast is not premium
  ([242352c](https://code.castopod.org/adaures/castopod/commit/242352c4d9cd936de14e8e8a5d78ebf1287b1f95))
- **premium-podcasts:** return different cached page when podcast is unlocked
  ([b1303c5](https://code.castopod.org/adaures/castopod/commit/b1303c525517498b0edfb9885ff36e08c72628b5))
- **pwa:** add scope to webmanifests to allow installing an app per podcast
  ([74c683e](https://code.castopod.org/adaures/castopod/commit/74c683eb44398a84443ec17903c3e002bb5ea9b9))
- **pwa:** set app display as standalone in the webmanifests
  ([7aa37d2](https://code.castopod.org/adaures/castopod/commit/7aa37d24ac13a1ee160c01a56b43621d7efcfbbc))
- re-order graph values
  ([35f633b](https://code.castopod.org/adaures/castopod/commit/35f633b4c71c087d1ddc9bba9e9bbe18de09204f))
- redirect to non cached views when authenticated in public views
  ([482b47b](https://code.castopod.org/adaures/castopod/commit/482b47ba6bdab7f27fc5704a559567228e07cd14))
- **release:** add missing version number to castopod-host package
  ([8f3e9d9](https://code.castopod.org/adaures/castopod/commit/8f3e9d90c14545d3f84d4469b26a53db4554b4dc))
- remove cache from remote follow form to display error messages
  ([90e4443](https://code.castopod.org/adaures/castopod/commit/90e44437bdf37d8024ef609b2f7336dbdfc3b974))
- remove defer from js script declaration as it is a module
  ([18ae557](https://code.castopod.org/adaures/castopod/commit/18ae557e97f1cef775cd1e75fb1fedee7f1c0cc9))
- remove fixed size from podcast sidebar + rearrange account info + space out
  import radio inputs
  ([776eec6](https://code.castopod.org/adaures/castopod/commit/776eec6f0d533d6c92ebec16f7a9dbfcde1f41f4))
- remove heavy image cover data from audio file metadata
  ([f74403b](https://code.castopod.org/adaures/castopod/commit/f74403bd7a5089b760603abe36264e7615be0e78))
- remove required for other_categories field and add podcast_id to latest
  podcasts query
  ([5417be0](https://code.castopod.org/adaures/castopod/commit/5417be0049288489a19c7b575aa77bd1e2bc0243))
- remove required property to persons picture
  ([c546be3](https://code.castopod.org/adaures/castopod/commit/c546be385b243014243ae93356006cd126d2f00d)),
  closes [#125](https://code.castopod.org/adaures/castopod/issues/125)
- remove value escaping for form inputs and textareas
  ([bc6dea2](https://code.castopod.org/adaures/castopod/commit/bc6dea2f8ad1cf0aee0eaa93151332fbac7fb771))
- rename field status to task_status to get scheduled activities
  ([4ff82a5](https://code.castopod.org/adaures/castopod/commit/4ff82a5f0a38dbbc9e272fca7df70ea5a190e334))
- rename issue_templates labels
  ([9f00305](https://code.castopod.org/adaures/castopod/commit/9f00305844e5a168e89d727fe29892b4ad5e48d6))
- rename MyAccount controller file
  ([e109df3](https://code.castopod.org/adaures/castopod/commit/e109df3004a3a98d72de39532e062fff9917f50f)),
  closes [#60](https://code.castopod.org/adaures/castopod/issues/60)
- rename podcast name to podcast handle to clarify field usage
  ([9dd4c77](https://code.castopod.org/adaures/castopod/commit/9dd4c7741eb1b7cb5fc214ff674697f3aa986df0)),
  closes [#126](https://code.castopod.org/adaures/castopod/issues/126)
- reorder fields as composite primary keys for analytics tables
  ([9660aa9](https://code.castopod.org/adaures/castopod/commit/9660aa97c8ffd4fe61f3a388d52b9ac5dd8e1d63))
- replace deletedField with published_at for episodes
  ([14d7d07](https://code.castopod.org/adaures/castopod/commit/14d7d078225cdc8980759273a5dc4163d9f84b06))
- replace getWebEnclosureUrl with getEnclosureWebUrl
  ([8122cea](https://code.castopod.org/adaures/castopod/commit/8122ceaf8a70050f14b3078f28b024e7d7cdb9ac))
- replace hardcoded style links with vite service + set default value for remote
  transcript url
  ([3f2e056](https://code.castopod.org/adaures/castopod/commit/3f2e05608e43d47bbb518a9acfaf56ec3eefafb4)),
  closes [#149](https://code.castopod.org/adaures/castopod/issues/149)
  [#150](https://code.castopod.org/adaures/castopod/issues/150)
- replace website key for webpages in breadcrumb translate file
  ([50e32ff](https://code.castopod.org/adaures/castopod/commit/50e32ff75636c1d4c5d945a267e884cb26ad7191))
- restore default podcast icon on public website
  ([342778b](https://code.castopod.org/adaures/castopod/commit/342778bac3c684328d72633961df1a2ebdc1330e))
- revert to beta.1's codeigniter4 version
  ([e831411](https://code.castopod.org/adaures/castopod/commit/e83141127080ccde44987195db46ba97fd6cc2ca))
- rewrite regenerate image function to use saveSizes method from Image entity
  ([3889912](https://code.castopod.org/adaures/castopod/commit/38899124ec27e94a8c798bc2db528f9f785eec20))
- **router:** check if Accept header is set before getting value
  ([10a2ae0](https://code.castopod.org/adaures/castopod/commit/10a2ae02484672d6a0fbc6e7b943519c5ec16cb6)),
  closes [#228](https://code.castopod.org/adaures/castopod/issues/228)
- **router:** trim URI slash to match same routes for URIs with and without
  trailing slash
  ([9e9375f](https://code.castopod.org/adaures/castopod/commit/9e9375f9a2cd6102f827b36ec521f4c86a557c00))
- **rss-import:** add Castopod user-agent, handle redirects for downloaded
  files, add Content namespace
  ([214243b](https://code.castopod.org/adaures/castopod/commit/214243b3fec4937e45ef1ceaba1149004cdf3b44))
- **rss:** cast number type values to string in rss_helper
  ([7180ae9](https://code.castopod.org/adaures/castopod/commit/7180ae9ec700930b69c04ed91f8eceea16ad77ce)),
  closes [#148](https://code.castopod.org/adaures/castopod/issues/148)
- **rss:** do not escape podcast and episode titles in the xml
  ([0dd3b7e](https://code.castopod.org/adaures/castopod/commit/0dd3b7e0bf00d5a9eb80c93cba1efcada59ec3c1)),
  closes [#138](https://code.castopod.org/adaures/castopod/issues/138)
  [#71](https://code.castopod.org/adaures/castopod/issues/71)
- **rss:** remove escaping for publisher and owner name
  ([6fc6347](https://code.castopod.org/adaures/castopod/commit/6fc6347846c126618cb7ff50164181650308d0c0))
- **rss:** round episode durations and soundbites
  ([c9fb987](https://code.castopod.org/adaures/castopod/commit/c9fb987fcfbe17069ec68fdbc823777079ce574b)),
  closes [#214](https://code.castopod.org/adaures/castopod/issues/214)
- **rss:** set ❬itunes:author❭ tag to owner_name if publisher not specified
  ([2271c14](https://code.castopod.org/adaures/castopod/commit/2271c1445b1ded12bc53b5d23b5e59d12b17c71a)),
  closes [#96](https://code.castopod.org/adaures/castopod/issues/96)
- **rss:** use originalPath instead of originalMediaPath in Image library
  ([b4012b7](https://code.castopod.org/adaures/castopod/commit/b4012b7d2ed6b34b69ad767570dd33f0dc7db920))
- save transcript and chapters files to podcasts folder
  ([63f49c7](https://code.castopod.org/adaures/castopod/commit/63f49c719f672b615c5a8893d3868dffcd332e47))
- **search-episodes:** add fallback sql query using LIKE for search query with
  less than 4 characters
  ([e66bf44](https://code.castopod.org/adaures/castopod/commit/e66bf44341175bc5a10fbf7dfa00b351e76136c2)),
  closes [#236](https://code.castopod.org/adaures/castopod/issues/236)
- **security:** add csrf filter + prevent xss attacks by escaping user input
  ([cd2e1e1](https://code.castopod.org/adaures/castopod/commit/cd2e1e1dc37c53d32d00971c451c4800b8fd6107))
- set cache expiration to next note publish to show note on publication date
  ([0a66de3](https://code.castopod.org/adaures/castopod/commit/0a66de3e6c17d4ac94ee8e13bd00ceaf64b1303e))
- set episode description footer to null when empty value
  ([3a7d97d](https://code.castopod.org/adaures/castopod/commit/3a7d97d660046d80698611311ff3708110d2af82))
- set episode duration translation to hardcoded english
  ([c39efc9](https://code.castopod.org/adaures/castopod/commit/c39efc9489180662edcebd142d4476c0617ea97f)),
  closes [#64](https://code.castopod.org/adaures/castopod/issues/64)
- set episode guid upon episode creation
  ([ad8b153](https://code.castopod.org/adaures/castopod/commit/ad8b153f2a3b1a3b1751bf63785c4950e1516e6b)),
  closes [#48](https://code.castopod.org/adaures/castopod/issues/48)
- set episode numbers during import + remove all custom form_helpers + minor ui
  issues
  ([99a3b8d](https://code.castopod.org/adaures/castopod/commit/99a3b8d33e00482da50dd62bdaa9215a351a56e4))
- set interact_as_actor for user upon password reset
  ([ad8f5f5](https://code.castopod.org/adaures/castopod/commit/ad8f5f5a0fac7b0b9cc10a0b86200f014aca7553)),
  closes [#178](https://code.castopod.org/adaures/castopod/issues/178)
- set localized slug_field key as string in french language
  ([17fb29b](https://code.castopod.org/adaures/castopod/commit/17fb29b20993b7deee4e252e0e3a4a2459ee0d98))
- set location to null when getting empty string
  ([71b1b5f](https://code.castopod.org/adaures/castopod/commit/71b1b5f775af475b1dc78328330e277f565e41b6))
- set storage limit as disk_total_space instead of free space
  ([7512e2e](https://code.castopod.org/adaures/castopod/commit/7512e2ed1ff5656cd63a4fc2524296dbb8b4164a))
- **settings:** add .jpg extension to site-icon file input to display all jpeg
  images
  ([f611a16](https://code.castopod.org/adaures/castopod/commit/f611a16cd0c1a389e1c5a287eaec9d2a927a4bb6))
- **socialinteract:** move social interact uri into uri attribute + update
  social data upon import
  ([12b2200](https://code.castopod.org/adaures/castopod/commit/12b22008a237185cb736fc29352fab22421dad16))
- sort episodes by published_at with unpublished episodes at the beginning
  ([1686f84](https://code.castopod.org/adaures/castopod/commit/1686f840d16f2bd3d71d7f222a59b8e6a838fd6e)),
  closes [#249](https://code.castopod.org/adaures/castopod/issues/249)
- sort episodic podcasts by season
  ([d7b6794](https://code.castopod.org/adaures/castopod/commit/d7b6794f68f9a01fd606a407c6eb4c12d15dee74))
- **themes:** update themes stylesheet route and remove css extension
  ([e4e7e00](https://code.castopod.org/adaures/castopod/commit/e4e7e0005e931967dd6162588f1c5913dbf4603e))
- **types:** update fake seeders types + fix bugs
  ([76a4bf3](https://code.castopod.org/adaures/castopod/commit/76a4bf344160df679db29e236e7df7822970fb60))
- **ui:** remove empty tooltip when hovering on sponsor button
  ([40aa661](https://code.castopod.org/adaures/castopod/commit/40aa661289e1d1517fffcea5d257183bc9c458e4))
- unpublish episode before deleting it + add validation step before deletion
  ([f75bd76](https://code.castopod.org/adaures/castopod/commit/f75bd76458eeb01a2d37912695e33f77d03b7a69)),
  closes [#112](https://code.castopod.org/adaures/castopod/issues/112)
  [#55](https://code.castopod.org/adaures/castopod/issues/55)
- update .htaccess for shared hosting config
  ([2379826](https://code.castopod.org/adaures/castopod/commit/2379826352e2f4b5060910bf9f29268610102f2e))
- update broken contributor dropdown fields
  ([e5b7515](https://code.castopod.org/adaures/castopod/commit/e5b75150234bd7f19e01def93425d3bda7379dd3))
- update condition in AnalyticsTrait
  ([fbc0967](https://code.castopod.org/adaures/castopod/commit/fbc0967caa81630d514ddb1b93b0834ebb4d913b))
- update condition in home controller to redirect to install page
  ([33f1b91](https://code.castopod.org/adaures/castopod/commit/33f1b91d55dd0652c979d50fc85879dbf88a4a42))
- update conditions when checking for empty max_episodes and season_number
  ([fbad0b5](https://code.castopod.org/adaures/castopod/commit/fbad0b59f68c65eba2fdcd5a8d3b312b622e9a45))
- update form_textarea to prevent escaping value
  ([78548b5](https://code.castopod.org/adaures/castopod/commit/78548b5cd75ea7d6688d1945ff5449ea4f6bec68))
- update iso-369 language table seeder
  ([0c90db4](https://code.castopod.org/adaures/castopod/commit/0c90db44c40de5af5b0b32b54489bda9424d9ef6))
- update ivoox podcasting icon
  ([f2b69a4](https://code.castopod.org/adaures/castopod/commit/f2b69a47339c887f57883ec612f3d200e512ac1c))
- update MarkdownEditor component + restyle Button and other components
  ([b05d177](https://code.castopod.org/adaures/castopod/commit/b05d177f1b7f44fef043ac5eb41f07133a2cf52d))
- update purgecss content path for php helper files
  ([eb70bb4](https://code.castopod.org/adaures/castopod/commit/eb70bb4f7078ff347aeb8f5dcc7896311d289466)),
  closes [#59](https://code.castopod.org/adaures/castopod/issues/59)
- update translations for settings' tasks to include what they should be used
  for
  ([06b1a8b](https://code.castopod.org/adaures/castopod/commit/06b1a8b29b6ce5d81c5570d250bdac4e0c9ee5ca))
- use slash instead of backslash to call layout
  ([a80adb2](https://code.castopod.org/adaures/castopod/commit/a80adb22958fc0a38374cbce2d950a0042e699eb))
- use UTC_TIMESTAMP() to get current utc date instead of NOW() in sql queries
  ([4e22a0d](https://code.castopod.org/adaures/castopod/commit/4e22a0d5e4b60941d41071f059aac80cbaf38fbf))
- **users:** remove required roles input when editing user + prevent owner's
  roles from being edited
  ([1c8af75](https://code.castopod.org/adaures/castopod/commit/1c8af7550ba27d8c8473ae96acd21ad7731fd863)),
  closes [#239](https://code.castopod.org/adaures/castopod/issues/239)
- **ux:** allow for empty message upon episode publication and warn user on
  submit
  ([33d01b8](https://code.castopod.org/adaures/castopod/commit/33d01b8d4fd6ebf24e9f011aa705c456c846956c)),
  closes [#129](https://code.castopod.org/adaures/castopod/issues/129)
- **ux:** have podcast dashboard card link to podcast dashboard if only one
  podcast in instance
  ([7dabee5](https://code.castopod.org/adaures/castopod/commit/7dabee58a187abe92358d962da506a836e29cda3))
- **ux:** redirect user to install page on database error in home page
  ([9017e30](https://code.castopod.org/adaures/castopod/commit/9017e30bf41bed8c2be65091bbc5fb1e63aef87a))
- validate slug length when submitting episode form + clean permalink edit
  prefix
  ([b07ac09](https://code.castopod.org/adaures/castopod/commit/b07ac093b2cae646f9a897bc9dfeeaef6eda6561))
- **video-clips:** check if created video exists before recreating it and
  failing
  ([dff1208](https://code.castopod.org/adaures/castopod/commit/dff12087251b2b89e195604202094b5ddd9a0936))
- **video-clips:** clear video clip cache after process has finished
  ([3ae6232](https://code.castopod.org/adaures/castopod/commit/3ae62325856f6ff331a5d9ed901b9fa097ca7055))
- **video-clips:** create unique temporary files for resources to be deleted
  after generation
  ([7f7c878](https://code.castopod.org/adaures/castopod/commit/7f7c878cb6ecf7b4a967b2af87da82bc6593081e))
- **video-clips:** set audio codec to aac, fixing audio issue on twitter
  ([3c22c68](https://code.castopod.org/adaures/castopod/commit/3c22c68ee81f77bd7fcf7e2739ee6af016407843))
- **video-clips:** set longer podcast and episode lengths for squared format
  ([c030113](https://code.castopod.org/adaures/castopod/commit/c0301134c2048dc29eb2b995e4d5c22c49444100))
- **video-clips:** tweak portrait parameters to have subtitles display without
  overflowing
  ([2385b1a](https://code.castopod.org/adaures/castopod/commit/2385b1a2926d1344569836e18cb30adb4c604664))
- **video-clips:** update condition to check if ffmpeg is installed
  ([b57f0b6](https://code.castopod.org/adaures/castopod/commit/b57f0b6eb65dccf22cb4d55f93d18ca36857d7fc)),
  closes [#163](https://code.castopod.org/adaures/castopod/issues/163)
- **xml-editor:** escape xml editor's content + restyle form sections to prevent
  overflowing
  ([588590b](https://code.castopod.org/adaures/castopod/commit/588590bd2c0346e2465ff8f1930580d76a3bf068))
- **xml-editor:** prettify xml even without root node
  ([ca55c24](https://code.castopod.org/adaures/castopod/commit/ca55c248d0562a8529071c1f10be12f40ef50dda))

### Features

- **activitypub:** add Podcast actor and PodcastEpisode object with comments
  ([9e1e5d2](https://code.castopod.org/adaures/castopod/commit/9e1e5d2e862d6a3345d11ca7f96b955c76bfa013))
- add about page in admin with instance info + database update button
  ([d0836f3](https://code.castopod.org/adaures/castopod/commit/d0836f3ee360a836f815c59ea755f288501dc517))
- add alternate rss feed link tag to podcast page head
  ([a973c09](https://code.castopod.org/adaures/castopod/commit/a973c097d54a3d0186c4079b9d4d3e81aae38505)),
  closes [#35](https://code.castopod.org/adaures/castopod/issues/35)
- add analytics and unknown useragents
  ([ec92e65](https://code.castopod.org/adaures/castopod/commit/ec92e65aa42e09b1df04600b52a0c679dfc494bb))
- add audio-clipper toolbar + add video-clip-previewer
  ([0255753](https://code.castopod.org/adaures/castopod/commit/02557539e6eb48fc23ee2ee3b0c75aee3310965b))
- add audio-clipper webcomponent (wip)
  ([21d4251](https://code.castopod.org/adaures/castopod/commit/21d4251b9bcd5acb0f8a1761bc4edc34a3dbc228))
- add autofocus to input field "Email or username" on login page
  ([19caed4](https://code.castopod.org/adaures/castopod/commit/19caed4bce0daab9ccf6ab9645f44b60eb87de88))
- add basic stats on podcast about page
  ([1670558](https://code.castopod.org/adaures/castopod/commit/1670558473dba47219d470ff21d6224db6ab42ba))
- add breadcrumb in admin area
  ([7fb1de2](https://code.castopod.org/adaures/castopod/commit/7fb1de2cf3c97c4cd7afe3bd71bbe66041786ecd)),
  closes [#17](https://code.castopod.org/adaures/castopod/issues/17)
- add cache to ActivityPub sql queries + cache activity and note pages
  ([2d297f4](https://code.castopod.org/adaures/castopod/commit/2d297f45b3d7ef6e8711875a0b9b908e878115fa))
- add CDN url
  ([972bcbf](https://code.castopod.org/adaures/castopod/commit/972bcbf65ee119b8641ca3c4e5c0e8cf9ca8dd4f)),
  closes [#37](https://code.castopod.org/adaures/castopod/issues/37)
- add codemirror to display xml editor for custom rss field
  ([f15f262](https://code.castopod.org/adaures/castopod/commit/f15f26240cd5311fa9d07779f364b6639a501dec))
- add cumulative listening time charts
  ([588b4d2](https://code.castopod.org/adaures/castopod/commit/588b4d28da00bc12d02126e23181690f54d81716))
- add default icons to Alert component
  ([0d98001](https://code.castopod.org/adaures/castopod/commit/0d9800123b135e4fa1a2acd14a5e039c12174333))
- add DropdownMenu component + remove global audio player in admin
  ([abb7fba](https://code.castopod.org/adaures/castopod/commit/abb7fbac276d77b7d31a0aeba75d464f3ba3ad46))
- add episode_numbering() component helper to display episode and season numbers
  ([3f4a6bd](https://code.castopod.org/adaures/castopod/commit/3f4a6bd0b9f870f16107a41b102b6bf734868198))
- add french translation
  ([196920d](https://code.castopod.org/adaures/castopod/commit/196920d62f1810b4c35f800d17d7f93627319091))
- add heading component + update ecs rules to fix views
  ([23bdc6f](https://code.castopod.org/adaures/castopod/commit/23bdc6f8e36b7e8dfbe32755a54dea59ad913432))
- add housekeeping task to run after migrations
  ([89dee41](https://code.castopod.org/adaures/castopod/commit/89dee41d583e57251ea9315402a757f03571d7ad))
- add install wizard form to bootstrap database and create the first superadmin
  user
  ([cba871c](https://code.castopod.org/adaures/castopod/commit/cba871c5df9f7120c44d9952456ebbd0d220669e)),
  closes [#2](https://code.castopod.org/adaures/castopod/issues/2)
- add instructions on production error page to ease Castopod debugging process
  ([9eab54e](https://code.castopod.org/adaures/castopod/commit/9eab54e0853ccb8300d9f9b743cd84aefbf06549)),
  closes [#224](https://code.castopod.org/adaures/castopod/issues/224)
- add ISO 3166 country codes
  ([97cd94b](https://code.castopod.org/adaures/castopod/commit/97cd94b47494b66faf43fbbe0748872da80020a4))
- add js audio player on podcast, admin and embeddable player pages + fix admon
  episodes ux
  ([0e14eb4](https://code.castopod.org/adaures/castopod/commit/0e14eb4d3f526b0fd256a6144f3fbfc3fe52a357)),
  closes [#131](https://code.castopod.org/adaures/castopod/issues/131)
- add label to sponsor button on podcast page
  ([c29c018](https://code.castopod.org/adaures/castopod/commit/c29c018c7a543fc9398b5d7d11f086123e2b33f2)),
  closes [#162](https://code.castopod.org/adaures/castopod/issues/162)
- add legalNoticeURL to app config for setting an external url to legal notice
  ([711843a](https://code.castopod.org/adaures/castopod/commit/711843a0c81e1e2ec7a015431786df4ef32d5092))
- add lock podcast according to the Podcastindex podcast-namespace to prevent
  unauthorized import
  ([72b3012](https://code.castopod.org/adaures/castopod/commit/72b301272e0b70ded3e2b237391909e3f152ad0b))
- add map analytics, add episodes analytics, clean analytics page layout,
  translate countries
  ([07eae83](https://code.castopod.org/adaures/castopod/commit/07eae83a00d860e149359fae67d549488403d88b))
- add media entity and link documents, images and audio files to it
  ([6ecf286](https://code.castopod.org/adaures/castopod/commit/6ecf2866cfcde31a0840f15c3340808ce14b44cf))
- add notifications inbox for actors
  ([999999e](https://code.castopod.org/adaures/castopod/commit/999999e3efab7b1aad7568e4fd114dc7bac04f38)),
  closes [#215](https://code.castopod.org/adaures/castopod/issues/215)
- add Noto Sans Mono font to use for durations + button to access new video clip
  form in list
  ([7609bb6](https://code.castopod.org/adaures/castopod/commit/7609bb60330539aa91bfdafbb35c2d585624218a))
- add npm for js dependencies + move src/ files to root folder
  ([cbb83a6](https://code.castopod.org/adaures/castopod/commit/cbb83a6f308ac9357e9fb0cca5edae9d3fee5b48))
- add Open Graph and Twitter meta tags
  ([af970b8](https://code.castopod.org/adaures/castopod/commit/af970b8bac949e4c63047e04aca1b7403a4e8deb)),
  closes [#41](https://code.castopod.org/adaures/castopod/issues/41)
- add pages table to store custom instance pages (eg. legal-notice, cookie
  policy, etc.)
  ([9c224a8](https://code.castopod.org/adaures/castopod/commit/9c224a8ac6dd95f3c6c087a300fc8bac48e8090f)),
  closes [#24](https://code.castopod.org/adaures/castopod/issues/24)
- add permanent delete feature for podcasts 🎉
  ([dbb4030](https://code.castopod.org/adaures/castopod/commit/dbb4030da49f9ea1f61759fb7c66d71fc29ea4a1)),
  closes [#89](https://code.castopod.org/adaures/castopod/issues/89)
- add platform models
  ([a333d29](https://code.castopod.org/adaures/castopod/commit/a333d291966229a909c0851fd8b890ed97c48ceb))
- add platforms form in podcast settings
  ([043f49c](https://code.castopod.org/adaures/castopod/commit/043f49c784bc007ca0fa756ca4ed2d3b08843ad9))
- add platforms tables
  ([ce59344](https://code.castopod.org/adaures/castopod/commit/ce5934419a516c9926dd3fd0ace3c11a95b60722))
- add podcast banner field for each podcast + refactor images configuration
  ([4a8147b](https://code.castopod.org/adaures/castopod/commit/4a8147bfbbd98d9badfc57a0f2a18bdd5812e802))
- add premium podcasts to manage subscriptions for premium episodes
  ([3234500](https://code.castopod.org/adaures/castopod/commit/3234500e2d967438ad140f65da801a543f43775d)),
  closes [#193](https://code.castopod.org/adaures/castopod/issues/193)
- add publish feature for podcasts and set draft by default
  ([3d363f2](https://code.castopod.org/adaures/castopod/commit/3d363f2efe99836ac05c305a2fa683e342f06561)),
  closes [#128](https://code.castopod.org/adaures/castopod/issues/128)
  [#220](https://code.castopod.org/adaures/castopod/issues/220)
- add remote_url alternative for transcript and chapters files
  ([3143c9a](https://code.castopod.org/adaures/castopod/commit/3143c9ad36e4cf1364205cf2be39c0c96f80fdd2))
- add replied to post or comment to reply element
  ([d0f9c60](https://code.castopod.org/adaures/castopod/commit/d0f9c6018f1af527099f3e26b5d824710fa11caf))
- add schema.org json-ld objects to podcasts, episodes, posts and comments pages
  ([902f959](https://code.castopod.org/adaures/castopod/commit/902f959b30a10839684f093eb86edebc5d826a0b))
- add task to housekeeping setting for resetting all instance counts
  ([9303e51](https://code.castopod.org/adaures/castopod/commit/9303e51bc50d730a8026f58984e83b840360ee88))
- add unique listeners analytics
  ([3a49258](https://code.castopod.org/adaures/castopod/commit/3a4925816f3268230640525ad7af507aab8eecb9))
- add update rss feed feature for podcasts to import their latest episodes
  ([5eb9dc1](https://code.castopod.org/adaures/castopod/commit/5eb9dc168eb9af04767829b76242c9120f55d46d)),
  closes [#183](https://code.castopod.org/adaures/castopod/issues/183)
- add user permissions and basic groups to handle authorizations
  ([d58e518](https://code.castopod.org/adaures/castopod/commit/d58e51874a4722921b75b0049117015c2380406e)),
  closes [#3](https://code.castopod.org/adaures/castopod/issues/3)
  [#18](https://code.castopod.org/adaures/castopod/issues/18)
- add WebSub module for pushing feed updates to open hubs
  ([10d3f73](https://code.castopod.org/adaures/castopod/commit/10d3f73786ba141e27a822b2585c4a244ee92c14))
- **admin:** add instance wide dashboard with storage and bandwidth usage
  ([b1a6c02](https://code.castopod.org/adaures/castopod/commit/b1a6c02e56fdc01a7ff69fa7e7dd8ea71380b7ba)),
  closes [#216](https://code.castopod.org/adaures/castopod/issues/216)
- **admin:** add search form in podcast episodes list
  ([6be5d12](https://code.castopod.org/adaures/castopod/commit/6be5d12877342a7c56e25ea8dd15a975c6ce45ac)),
  closes [#26](https://code.castopod.org/adaures/castopod/issues/26)
- **admin:** make header stick on scroll and show title + action buttons using
  css only
  ([d60498c](https://code.castopod.org/adaures/castopod/commit/d60498c1beb970a14eeb3bbe02d1b1d8116624b0))
- **admin:** update admin layout for better ux + update brand pine colors
  ([d86142e](https://code.castopod.org/adaures/castopod/commit/d86142ebe7cd7582835f180b79fbeaaaba703528))
- allow cross origin requests on episode comments
  ([e12f95a](https://code.castopod.org/adaures/castopod/commit/e12f95aca13c6d54489a9cfd99d4cd2490fe83ab))
- **analytics-gdpr:** update cached personal data to expire at midnight
  ([0188b67](https://code.castopod.org/adaures/castopod/commit/0188b67354a756f0c926edd7b46623ab5b20c12b))
- **analytics:** add 'other' group to pie charts in order to display more
  accurate data
  ([73acef9](https://code.castopod.org/adaures/castopod/commit/73acef933ff3485987afc5157de022910876fc12))
- **analytics:** add charts and data export
  ([78625c4](https://code.castopod.org/adaures/castopod/commit/78625c471b4f03a09bd42f72b82217e1f2d01cef))
- **analytics:** add current date and secret salt to analytics hash for improved
  privacy
  ([6f2e7c0](https://code.castopod.org/adaures/castopod/commit/6f2e7c009c24830d4f08633bfbde3b75f40bf215))
- **analytics:** add service name from rss user-agent
  ([7202b98](https://code.castopod.org/adaures/castopod/commit/7202b9867bd59aafa8c338a4230fb5e5c55b24c6))
- **analytics:** add weekday and hour bar charts
  ([8ab3132](https://code.castopod.org/adaures/castopod/commit/8ab313296bb4a254ab05e90b17d896039839b784))
- **api:** add rest api with podcasts read endpoints
  ([e64001d](https://code.castopod.org/adaures/castopod/commit/e64001d00604bcf587ec5e9a631282f212df450d)),
  closes [#210](https://code.castopod.org/adaures/castopod/issues/210)
- apply colour theme to embed player
  ([9548337](https://code.castopod.org/adaures/castopod/commit/9548337a7c49879e8b58c2dfece46e3cfc9517eb)),
  closes [#201](https://code.castopod.org/adaures/castopod/issues/201)
- **auth:** add auth.enable2FA config to enable two-factor authentication
  ([7213ed2](https://code.castopod.org/adaures/castopod/commit/7213ed290c977ce8723f6d92addadc03913576ee))
- build hashed static files to renew browser cache
  ([37c54d2](https://code.castopod.org/adaures/castopod/commit/37c54d247749bdf8f528babd4a78f24d48051063)),
  closes [#107](https://code.castopod.org/adaures/castopod/issues/107)
- **cache:** add podcast and episode pages to cache + clear them after insert or
  update
  ([da0f047](https://code.castopod.org/adaures/castopod/commit/da0f0472819007e02e5da37399f2377772c618b9))
- **categories:** create model, entity, migrations and seeds
  ([f73b042](https://code.castopod.org/adaures/castopod/commit/f73b042cc091be82abdbbca8992080875d526972))
- **clips:** setup clip entities and model + save video clip to have it
  generated in the background
  ([2f6fdf9](https://code.castopod.org/adaures/castopod/commit/2f6fdf9091d52ca49709fc82621ba1c6dd0e817d))
- **comments:** add comments to episodes + update naming of status to post
  ([bb4752c](https://code.castopod.org/adaures/castopod/commit/bb4752c35e086664f5fd75fdc0d56546a1e356f6))
- **comments:** add like / undo like to comment + add comment page
  ([0c187ef](https://code.castopod.org/adaures/castopod/commit/0c187ef7a9278a60bcc6e5ee4d69d948b51e5c54))
- **components:** add custom view renderer with ComponentRenderer adapted from
  bonfire2
  ([a95de8b](https://code.castopod.org/adaures/castopod/commit/a95de8bab010f6b01c598da72191abe97e473687))
- create optimized & resized images upon upload
  ([02e4441](https://code.castopod.org/adaures/castopod/commit/02e4441f98f27e9534e5b9b63279153d14632ccd)),
  closes [#6](https://code.castopod.org/adaures/castopod/issues/6)
- **custom-rss:** add custom xml tag injection in rss feed for ❬channel❭ and
  ❬item❭
  ([6ecdaad](https://code.castopod.org/adaures/castopod/commit/6ecdaad911d06b7f7a2b7d24710968c7eb9118f6))
- **datetime-picker:** set material_green theme to flatpickr
  ([3ce6541](https://code.castopod.org/adaures/castopod/commit/3ce6541003260677e722a916ad6bc83ef47c4371))
- **devcontainer:** add devcontainer settings for dev environment
  ([69e7266](https://code.castopod.org/adaures/castopod/commit/69e72667365247b63430dee88194e8f0d7c28edc))
- display castopod version in admin footer
  ([9f2574e](https://code.castopod.org/adaures/castopod/commit/9f2574e6fbb61dac4e1a4252dff30017685da5f0)),
  closes [#68](https://code.castopod.org/adaures/castopod/issues/68)
- display legal disclaimer and warning on podcast import page
  ([2f07992](https://code.castopod.org/adaures/castopod/commit/2f07992e5508b34b91f194eebfac80c51e80e90a)),
  closes [#34](https://code.castopod.org/adaures/castopod/issues/34)
- edit + delete podcast and episode
  ([ac5f0c7](https://code.castopod.org/adaures/castopod/commit/ac5f0c732806e955c01e05b7867801bc938c6bd5))
- **embeddable-player:** add embeddable player widget
  ([141788f](https://code.castopod.org/adaures/castopod/commit/141788fa089f9dedc8956c64ca515a4a4625f904))
- enhance admin ui with responsive design and ux improvements
  ([2d44b45](https://code.castopod.org/adaures/castopod/commit/2d44b457a02205d2e7da258d7029b8bc5da39533)),
  closes [#31](https://code.castopod.org/adaures/castopod/issues/31)
  [#9](https://code.castopod.org/adaures/castopod/issues/9)
- enhance ui using javascript in admin area
  ([c0e66d5](https://code.castopod.org/adaures/castopod/commit/c0e66d5f7012026e145d106f4d6bd3ba792a1b77))
- **episode-unpublish:** remove episode comments upon unpublish
  ([78acd7f](https://code.castopod.org/adaures/castopod/commit/78acd7f5c057c82507d801c424040296dbaba586))
- **episode:** add form to allow editing episode's publication date to a past
  date
  ([d783d16](https://code.castopod.org/adaures/castopod/commit/d783d16eb73d3f896a3dea39a766b4e963e53abf)),
  closes [#97](https://code.castopod.org/adaures/castopod/issues/97)
- **episodes:** add create form and view pages for episode
  ([f3b2c8b](https://code.castopod.org/adaures/castopod/commit/f3b2c8b84f3d93bef734e34dbe8ed729535e45e9)),
  closes [#1](https://code.castopod.org/adaures/castopod/issues/1)
- **episodes:** add migrations, model and entity for episodes table
  ([0444821](https://code.castopod.org/adaures/castopod/commit/044482174ede555ce19a2d8c6f48771cc8e7d27b))
- **episodes:** replace all audio file URL parameters with base64 encoded data
  ([e1f65cd](https://code.castopod.org/adaures/castopod/commit/e1f65cd3b53353a30d4ab6eb5312393cf04a1676))
- **episodes:** replace soft delete with permanent delete
  ([eb9ff52](https://code.castopod.org/adaures/castopod/commit/eb9ff522c25af8ceb2ed08614b581757ee791d42))
- **episodes:** schedule episode with future publication_date by using cache
  expiration time
  ([4f1e773](https://code.castopod.org/adaures/castopod/commit/4f1e773c0f9e4c2597f6c1b0a4773dfb34b2f203)),
  closes [#47](https://code.castopod.org/adaures/castopod/issues/47)
- **fediverse:** implement activitypub protocols + update user interface
  ([2f525c0](https://code.castopod.org/adaures/castopod/commit/2f525c0f6e44d320bff16e22c223481923ba683e)),
  closes [#69](https://code.castopod.org/adaures/castopod/issues/69)
  [#65](https://code.castopod.org/adaures/castopod/issues/65)
  [#85](https://code.castopod.org/adaures/castopod/issues/85)
  [#51](https://code.castopod.org/adaures/castopod/issues/51)
  [#91](https://code.castopod.org/adaures/castopod/issues/91)
  [#92](https://code.castopod.org/adaures/castopod/issues/92)
  [#88](https://code.castopod.org/adaures/castopod/issues/88)
- **fonts:** replace Montserrat with Inter for better readability
  ([bfa11d0](https://code.castopod.org/adaures/castopod/commit/bfa11d007d04b8ac714c8cf3b8050a6aaf177a26))
- **GDPR:** add GDPR.yml file to public/.well-known/
  ([86bccc3](https://code.castopod.org/adaures/castopod/commit/86bccc3d5cc9562b89196f1766ac91cdc8ad786d))
- **gdpr:** add purpose for granting access to premium content
  ([47d6d81](https://code.castopod.org/adaures/castopod/commit/47d6d81b798ec3ed467e0f4339c98c8a6b80cecd))
- **home:** sort podcasts by recent activity + add dropdown menu to choose
  between sorting options
  ([7b89da6](https://code.castopod.org/adaures/castopod/commit/7b89da6106c150708782d39ed2742fe416c41e89)),
  closes [#164](https://code.castopod.org/adaures/castopod/issues/164)
- **housekeeping:** add clear_cache option to flush redis or files cache
  ([99bfac0](https://code.castopod.org/adaures/castopod/commit/99bfac0b428a4bc6fe8bfd10a355dfd93f42ba5c))
- **i18n:** add 7 new languages + update german translations
  ([d021abb](https://code.castopod.org/adaures/castopod/commit/d021abb52f5525d93810e25df2b453c918d7bc8b))
- **i18n:** add german language as supported locale + create Language files from
  english source
  ([c220b31](https://code.castopod.org/adaures/castopod/commit/c220b310ed59cad188af044b1fed0c39efc7da5b))
- **i18n:** add Norwegian Nynorsk to supported locales
  ([ced61fc](https://code.castopod.org/adaures/castopod/commit/ced61fc2364f954c1f6e0208b572faf5741498a8))
- **i18n:** add Polish translation
  ([2d83b44](https://code.castopod.org/adaures/castopod/commit/2d83b44add9e4e00766a1f326377ed892f48ad73))
- **i18n:** add Spanish to supported locales
  ([e340b54](https://code.castopod.org/adaures/castopod/commit/e340b54a84d7dcdf9ba910fe7ff39c453fac0968))
- **i18n:** add support for German and Brazilian Portuguese languages
  ([c9b9fe4](https://code.castopod.org/adaures/castopod/commit/c9b9fe4ee893de9a1df7f8269c39d08a90d205d6))
- **i18n:** add support for Simplified Chinese (zh-Hans) and Catalan (ca)
  locales
  ([48d1443](https://code.castopod.org/adaures/castopod/commit/48d14434727c3310a391160c7af02c56b7e20425))
- **icons:** add default icons for podcasting, social and funding platforms +
  remove complex icons
  ([5bcdfeb](https://code.castopod.org/adaures/castopod/commit/5bcdfebe6489b5d6b90f3c828b014ec4e9a7e7e1)),
  closes [#166](https://code.castopod.org/adaures/castopod/issues/166)
  [#167](https://code.castopod.org/adaures/castopod/issues/167)
  [#170](https://code.castopod.org/adaures/castopod/issues/170)
- **icons:** add podnews icon to podcasting platforms
  ([5f42355](https://code.castopod.org/adaures/castopod/commit/5f423557c2b78fd7c38c5e0caab6c6c80d21e36e)),
  closes [#190](https://code.castopod.org/adaures/castopod/issues/190)
- import podcast from an rss feed url
  ([9a5d5a1](https://code.castopod.org/adaures/castopod/commit/9a5d5a15b4945eb319da9e999c4ca60a0a4f6d2d)),
  closes [#21](https://code.castopod.org/adaures/castopod/issues/21)
- integrate stylized form components and update podcast edit page
  ([6536729](https://code.castopod.org/adaures/castopod/commit/653672954606a23796e8a7bda3c34fd6b92f84e0))
- make displayed publication time as relative time using @github/time-elements
  ([230e139](https://code.castopod.org/adaures/castopod/commit/230e139e43324b9ebef06ca8f6e13b3d9a7bdc70))
- make episode description more visible on episode pages
  ([90533be](https://code.castopod.org/adaures/castopod/commit/90533be0298249e5527870c01329fce5f94ec2dc)),
  closes [#171](https://code.castopod.org/adaures/castopod/issues/171)
- **map:** display geolocated episodes on a map page
  ([4357cc2](https://code.castopod.org/adaures/castopod/commit/4357cc25ccc585ce398035c1c25d566b6a9df775))
- **media:** clean media api + create an entity per media type
  ([fafaa7e](https://code.castopod.org/adaures/castopod/commit/fafaa7e689b17f09a2b056081fa1f4fc53bf716b))
- **media:** save audio, images, transcripts and chapters to media for episode
  and persons
  ([58e2a00](https://code.castopod.org/adaures/castopod/commit/58e2a00a87fa7d5b188e13cc521d94f0cfddba50))
- **meta-tags:** add activitypub alternate links to podcast, episode, comment
  and post pages
  ([bd61752](https://code.castopod.org/adaures/castopod/commit/bd61752be2f574323b05d1d0aee0df55adf9a74e))
- minor corrections to some tables
  ([3bf9420](https://code.castopod.org/adaures/castopod/commit/3bf9420b5956a501b3b24405d243a71a928d6086))
- **monetization:** add Web Monetization support
  ([96a6026](https://code.castopod.org/adaures/castopod/commit/96a6026f1db452085360f5fe248de82a2ec06468))
- **nodeinfo2:** add .well-known route for nodeinfo2 containing metadata about
  the castopod instance
  ([88fddc8](https://code.castopod.org/adaures/castopod/commit/88fddc81d730978f2a4d8a671936b54041e3fe45))
- **partner:** add link and image in episode description
  ([ad07bb9](https://code.castopod.org/adaures/castopod/commit/ad07bb9330dc9493813368e969e1f3a3def44614))
- **person:** add podcastindex.org namespace person tag
  ([8acd011](https://code.castopod.org/adaures/castopod/commit/8acd011f13e99492ef4b44b327685bb006fe5f8f))
- **platforms:** add AntennaPod
  ([53e9cfd](https://code.castopod.org/adaures/castopod/commit/53e9cfd61c794b1539e9d4691d3c4e73c4b7aaa7))
- **platforms:** add Fediverse and some funding platforms, add link on logo
  ([afc3d50](https://code.castopod.org/adaures/castopod/commit/afc3d50289bb4173e0697d109ffe72f6814b93d1))
- **platforms:** add helloasso
  ([16cb993](https://code.castopod.org/adaures/castopod/commit/16cb993ee6e28987a840fc27a9c2c73794c67697))
- **platforms:** add missing newpodcastapps.com's platforms
  ([92dd370](https://code.castopod.org/adaures/castopod/commit/92dd370e2f9a464edd26cddcde96d0e16f91548d))
- **platforms:** add pod.link
  ([3d7a232](https://code.castopod.org/adaures/castopod/commit/3d7a2320ddd116e4a311605421126aff57243219))
- **platforms:** add Podcast Index
  ([ad52b1c](https://code.castopod.org/adaures/castopod/commit/ad52b1cc2b7d0bc844970214d205961a7196b4a9))
- **platforms:** add podfriend
  ([9fdc8d3](https://code.castopod.org/adaures/castopod/commit/9fdc8d32930234c7ffd2be6892be57febcef1086))
- **podcast-form:** add new_feed_url field to set an url when changing domain or
  host
  ([e7eec48](https://code.castopod.org/adaures/castopod/commit/e7eec48e7bc06a9aa907db01ed3e5b536e7dd8be))
- **podcast-form:** update routes and redirect to podcast page
  ([12ce905](https://code.castopod.org/adaures/castopod/commit/12ce905799002dc9c07e6de092342d30ba9fd7d8))
- **podcast:** create a podcast using form
  ([1202ba3](https://code.castopod.org/adaures/castopod/commit/1202ba3545f521097c60a6a2af95e70527cd1d34))
- **podcasting 2.0:** update podcast:social tag to adhere to latest spec
  ([a597cf4](https://code.castopod.org/adaures/castopod/commit/a597cf4ecfa6807a3413177d99c816056a7e7c45))
- prefill season and episode numbers + set episode number as mandatory for
  serial podcasts
  ([07d740b](https://code.castopod.org/adaures/castopod/commit/07d740b79f9283e389e723954f680f909ce5de4a)),
  closes [#134](https://code.castopod.org/adaures/castopod/issues/134)
  [#136](https://code.castopod.org/adaures/castopod/issues/136)
- **public-ui:** adapt public podcast and episode pages to wireframes
  ([40a0535](https://code.castopod.org/adaures/castopod/commit/40a0535fc1bc12a24994b651f5e00b35995cbdda)),
  closes [#30](https://code.castopod.org/adaures/castopod/issues/30)
  [#13](https://code.castopod.org/adaures/castopod/issues/13)
- **pwa:** add service-worker + webmanifest for each podcasts to have them
  install on devices
  ([fee2c1c](https://code.castopod.org/adaures/castopod/commit/fee2c1c0d0d03c4ff0a6a207b0a5e0c22bb7b13a))
- redesign public podcast and episode pages + remove any information clutter for
  better ux
  ([9321400](https://code.castopod.org/adaures/castopod/commit/932140077c671f0486a2cd08ceb6126c7ecde87f))
- replace form helper functions with components in admin template
  ([e64548b](https://code.castopod.org/adaures/castopod/commit/e64548b982ba47ff35f2272e2e30dd85eeba950b))
- replace slug field with interactive permalink component
  ([578022b](https://code.castopod.org/adaures/castopod/commit/578022b8c5163ffaf8db5870ed5ec9d5d9536477))
- restyle episode and person cards + add focus style to interactive elements for
  a11y
  ([a505a1d](https://code.castopod.org/adaures/castopod/commit/a505a1de56e8e3056379bd60d0595f432e294728))
- **rss:** add ˂podcast:guid˃ tag for channel
  ([1fab10e](https://code.castopod.org/adaures/castopod/commit/1fab10eb0d63bb7c3edf34ffe691e2aec2c2e43c))
- **rss:** add podcast-namespace tags for platforms + previousUrl tag
  ([dbba8dc](https://code.castopod.org/adaures/castopod/commit/dbba8dc58133967c778514268cbfed8098ed1dbc)),
  closes [#73](https://code.castopod.org/adaures/castopod/issues/73)
  [#75](https://code.castopod.org/adaures/castopod/issues/75)
  [#76](https://code.castopod.org/adaures/castopod/issues/76)
  [#80](https://code.castopod.org/adaures/castopod/issues/80)
- **rss:** add podcast:comments tag to link to episode comments
  ([32e8c7c](https://code.castopod.org/adaures/castopod/commit/32e8c7c16a61ffe08e2f3bfbdeda556811a0358c))
- **rss:** add podcast:location tag
  ([c0a2282](https://code.castopod.org/adaures/castopod/commit/c0a22829bd87d48535a86e60c6cd7280e44683a2))
- **rss:** add rss feed route without the `.xml` extension
  ([94c0b7c](https://code.castopod.org/adaures/castopod/commit/94c0b7c15920dae9ade5cdc79c7996dbfe82ba05)),
  closes [#247](https://code.castopod.org/adaures/castopod/issues/247)
- **rss:** add soundbites according to the podcastindex specs
  ([6b34617](https://code.castopod.org/adaures/castopod/commit/6b34617d07c70522cb941e96d91d9987493413eb)),
  closes [#83](https://code.castopod.org/adaures/castopod/issues/83)
- **rss:** add transcript and chapters support
  ([e769d83](https://code.castopod.org/adaures/castopod/commit/e769d83a932c169e52a630a17cd4dd8ac5cebaf6)),
  closes [#72](https://code.castopod.org/adaures/castopod/issues/72)
  [#82](https://code.castopod.org/adaures/castopod/issues/82)
- **rss:** generate rss feed from podcast entity
  ([c815ecd](https://code.castopod.org/adaures/castopod/commit/c815ecd6640931fee0895f80908a3ddfac482666))
- **rss:** update monetization tag so that it meets PodcastIndex requirements
  ([4c7ecbe](https://code.castopod.org/adaures/castopod/commit/4c7ecbee83950e5f9f2482cedaab18a1ac9bfc9e))
- **select:** enhance select input with choices.js
  ([910d457](https://code.castopod.org/adaures/castopod/commit/910d457cf843e0fc334b3505a4727d51633395ac))
- set app parameter forceGlobalSecureRequests = true forcing requests to go
  through https
  ([d9dff1b](https://code.castopod.org/adaures/castopod/commit/d9dff1b8bf89c8b526ad6cb89f98a1f160d49117))
- set podcast / episode description in the pages description meta tag
  ([1c4a504](https://code.castopod.org/adaures/castopod/commit/1c4a50442bea2d3449efce9c5ff1c80743152f55)),
  closes [#44](https://code.castopod.org/adaures/castopod/issues/44)
- **settings:** add general config for instance (site name, description and
  icon)
  ([5c56f3e](https://code.castopod.org/adaures/castopod/commit/5c56f3e6f00a61af2ccf50811c155c325f2b10fa))
- **settings:** add theme settings to set an accent color for all public pages
  ([5c529a8](https://code.castopod.org/adaures/castopod/commit/5c529a83aa6d6147d94e5aee996e6b0ab02f0ce4))
- simplify podcast page's layout for better ux
  ([2c0efc6](https://code.castopod.org/adaures/castopod/commit/2c0efc6563604dd067be88cfc9ddd88a01745e64))
- **soundbites:** add soundbite list and creation forms with audio-clipper
  component
  ([de19317](https://code.castopod.org/adaures/castopod/commit/de19317138a2106deb825c1eed7dda036ed7dac3))
- style file inputs using tailwind's file class
  ([8208ab6](https://code.castopod.org/adaures/castopod/commit/8208ab6785aae8c49f78eb9ac8cd53d77ec8e5e5))
- **themes:** add ViewThemes library to set views in root themes folder
  ([7a27676](https://code.castopod.org/adaures/castopod/commit/7a276764e6a1ee3619d9d3488f6163215db75338))
- **themes:** set different default banner per theme
  ([11c916f](https://code.castopod.org/adaures/castopod/commit/11c916fe433eb749ac32230c48e256057564cbb0))
- **themes:** set generic css variables for colors to enable instance themes
  ([a746a78](https://code.castopod.org/adaures/castopod/commit/a746a781b4bfc78209cf8302c6d7bb3cb452e446))
- toggle podcast sidebar on smaller screens
  ([f0205ec](https://code.castopod.org/adaures/castopod/commit/f0205ec274414e881cba40d6776126f05eaee583))
- **transcript:** parse srt subtitles into json file + add max file size info
  below audio file input
  ([0098761](https://code.castopod.org/adaures/castopod/commit/00987610a068c8d6cdd4421ea16585fa037eb61a))
- **ui:** create ViewComponents library to enable building class and view files
  components
  ([94872f2](https://code.castopod.org/adaures/castopod/commit/94872f2338e6025c2f3770be256160838dae9003))
- update analytics so to meet IABv2 requirements
  ([03e23a2](https://code.castopod.org/adaures/castopod/commit/03e23a28bf9b1b73fba55352c36a8cd6cc8ae729)),
  closes [#10](https://code.castopod.org/adaures/castopod/issues/10)
- update pine colors + create charts components
  ([a50abc1](https://code.castopod.org/adaures/castopod/commit/a50abc138d4997b564e3065b37504cda5ce62da6))
- **users:** add myth-auth to handle users crud + add admin gateway only
  accessible by login
  ([c63a077](https://code.castopod.org/adaures/castopod/commit/c63a077618c61b4cde7f25ffc650a4b0e1495f44)),
  closes [#11](https://code.castopod.org/adaures/castopod/issues/11)
- **ux:** remove admin dashboard and redirect directly to podcast list
  ([27c48b8](https://code.castopod.org/adaures/castopod/commit/27c48b8fa930b33e5e15f0c8685e468e857ca9cd))
- **video-clip:** add video-clip page with video preview + logs
  ([42538dd](https://code.castopod.org/adaures/castopod/commit/42538dd7577be0ffe59b4fdfadbd76cc89e5ef30))
- **video-clip:** generate video clips in the bg using a cron job + add video
  clip page + tidy up UI
  ([db0e427](https://code.castopod.org/adaures/castopod/commit/db0e4272bd6d307c562e1f961d2747cb62de0f35))
- **video-clips:** add dimensions for portrait and squared formats
  ([3af404d](https://code.castopod.org/adaures/castopod/commit/3af404da3dd1901c78cc7e1778fc225f6716207d))
- **video-clips:** add new themes + add castopod logo as a watermark
  ([1d1490b](https://code.castopod.org/adaures/castopod/commit/1d1490b06a1f5ecb10b3b98a72efc55d09c10944))
- **video-clips:** add route for scheduled video clips + list video clips with
  status
  ([2065ebb](https://code.castopod.org/adaures/castopod/commit/2065ebbee5e3d0f890ac90b55ca984f1d62a184c))
- **video-clips:** allow episodeNumbering text to stand in the indent of
  episodeTitle paragraph
  ([71a063d](https://code.castopod.org/adaures/castopod/commit/71a063dac311cb21639801fbae6af7c5106c2699))
- **video-clips:** generate a 16:9 video using ffmpeg
  ([35aa7ea](https://code.castopod.org/adaures/castopod/commit/35aa7ea5d9a339b3e6f745137282268d69fe2231))
- **video-clips:** generate subtitles clip using transcript json to have
  subtitles across video
  ([3ce07e4](https://code.castopod.org/adaures/castopod/commit/3ce07e455d171e29be30d8ad45055510eb8d363c))
- **video-clips:** replace hardcoded colors with config's theme colors
  ([e462abf](https://code.castopod.org/adaures/castopod/commit/e462abf6d660e41d2170c52caf45704008de58e9))
- **vite:** add vite config to decouple it from CI_ENVIRONMENT
  ([8721719](https://code.castopod.org/adaures/castopod/commit/8721719cd7cf32e94823541eafaba1e9309355a8))
- write id3v2 tags to episode's audio file
  ([4651d01](https://code.castopod.org/adaures/castopod/commit/4651d01a84ff3ea8433a8ae26cfd750a1ec9e88d))

### Performance Improvements

- **cache:** update CI4 to use cache's deleteMatching method
  ([54b84f9](https://code.castopod.org/adaures/castopod/commit/54b84f96843af13f579fea49102c8c2ef81b0a54))
- **cache:** use deleteMatching method to prevent forgetting cached elements in
  models
  ([76afc0c](https://code.castopod.org/adaures/castopod/commit/76afc0cfa2feb087697bae4bc138e4956873dd62))
- defer javascript + lazy load images for faster page loads
  ([f0685e4](https://code.castopod.org/adaures/castopod/commit/f0685e44799dfb494592ff97841c0ae035381db8))
- **docker:** add redis caching service for development
  ([05ace8c](https://code.castopod.org/adaures/castopod/commit/05ace8cff2ef02d19abd40097ac5546dca6a54ca))

### Reverts

- **install:** redirect to install in homepage if no database was set
  ([73f094d](https://code.castopod.org/adaures/castopod/commit/73f094daf26a8cf75e39ebff1eeb7f9039276312))
- set deprecated config options back in App config
  ([433745f](https://code.castopod.org/adaures/castopod/commit/433745f194c73407999b207090478563283876a5))
- **soundbites:** remove soundbite table from episode's public page
  ([5dc0f19](https://code.castopod.org/adaures/castopod/commit/5dc0f19656de0d764f627d6ae78a9e306c901835))
- use basic input file for episodes audio files instead of button for better UX
  ([d5f22fb](https://code.castopod.org/adaures/castopod/commit/d5f22fbb38c43d9b37df401eff655958a57cb40a))

### BREAKING CHANGES

- **analytics:** analytics_podcasts_by_player table and analytics_podcasts
  procedure were updated

# [1.0.0-beta.24](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.23...v1.0.0-beta.24) (2022-10-14)

### Bug Fixes

- **router:** trim URI slash to match same routes for URIs with and without
  trailing slash
  ([9e9375f](https://code.castopod.org/adaures/castopod/commit/9e9375f9a2cd6102f827b36ec521f4c86a557c00))

### Features

- **episode:** add form to allow editing episode's publication date to a past
  date
  ([d783d16](https://code.castopod.org/adaures/castopod/commit/d783d16eb73d3f896a3dea39a766b4e963e53abf)),
  closes [#97](https://code.castopod.org/adaures/castopod/issues/97)
- **rss:** add rss feed route without the `.xml` extension
  ([94c0b7c](https://code.castopod.org/adaures/castopod/commit/94c0b7c15920dae9ade5cdc79c7996dbfe82ba05)),
  closes [#247](https://code.castopod.org/adaures/castopod/issues/247)

# [1.0.0-beta.23](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.22...v1.0.0-beta.23) (2022-09-29)

### Bug Fixes

- **premium-podcasts:** display unlock button in embed when premium episode
  ([ca109ba](https://code.castopod.org/adaures/castopod/commit/ca109ba3a8a08e661fd2484454b1983c3418f15d))
- **premium-podcasts:** remove cache in unlock form + redirect to podcast if
  podcast is not premium
  ([242352c](https://code.castopod.org/adaures/castopod/commit/242352c4d9cd936de14e8e8a5d78ebf1287b1f95))
- **premium-podcasts:** return different cached page when podcast is unlocked
  ([b1303c5](https://code.castopod.org/adaures/castopod/commit/b1303c525517498b0edfb9885ff36e08c72628b5))

### Features

- add instructions on production error page to ease Castopod debugging process
  ([9eab54e](https://code.castopod.org/adaures/castopod/commit/9eab54e0853ccb8300d9f9b743cd84aefbf06549)),
  closes [#224](https://code.castopod.org/adaures/castopod/issues/224)
- add premium podcasts to manage subscriptions for premium episodes
  ([3234500](https://code.castopod.org/adaures/castopod/commit/3234500e2d967438ad140f65da801a543f43775d)),
  closes [#193](https://code.castopod.org/adaures/castopod/issues/193)
- **gdpr:** add purpose for granting access to premium content
  ([47d6d81](https://code.castopod.org/adaures/castopod/commit/47d6d81b798ec3ed467e0f4339c98c8a6b80cecd))

# [1.0.0-beta.22](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.21...v1.0.0-beta.22) (2022-09-23)

### Bug Fixes

- **fediverse:** set default castopod avatar url when actor avatar is not
  present
  ([460f52f](https://code.castopod.org/adaures/castopod/commit/460f52f70e493d619c28632db6c698e88f0ebb5f))
- **import:** set default episode type if not set
  ([d7250ab](https://code.castopod.org/adaures/castopod/commit/d7250ab03f9b032830c575ad58b51c8d60b7a49a))
- **input-component:** unset required attribute to prevent rendering it when
  false
  ([db9ac13](https://code.castopod.org/adaures/castopod/commit/db9ac13860bce58235a5da275910bea605a00626))
- **notifications:** notify actors after activities insert / update using model
  callback methods
  ([e08555a](https://code.castopod.org/adaures/castopod/commit/e08555a4e9a6c15eeba18273c63403f82eddae35))
- overwrite getActorById to return app's Actor entity
  ([f2bc2f7](https://code.castopod.org/adaures/castopod/commit/f2bc2f7e01aa166faa627df6fe4d5ed4887c16e5))
- remove heavy image cover data from audio file metadata
  ([f74403b](https://code.castopod.org/adaures/castopod/commit/f74403bd7a5089b760603abe36264e7615be0e78))
- set storage limit as disk_total_space instead of free space
  ([7512e2e](https://code.castopod.org/adaures/castopod/commit/7512e2ed1ff5656cd63a4fc2524296dbb8b4164a))
- **ui:** remove empty tooltip when hovering on sponsor button
  ([40aa661](https://code.castopod.org/adaures/castopod/commit/40aa661289e1d1517fffcea5d257183bc9c458e4))
- **users:** remove required roles input when editing user + prevent owner's
  roles from being edited
  ([1c8af75](https://code.castopod.org/adaures/castopod/commit/1c8af7550ba27d8c8473ae96acd21ad7731fd863)),
  closes [#239](https://code.castopod.org/adaures/castopod/issues/239)
- **ux:** have podcast dashboard card link to podcast dashboard if only one
  podcast in instance
  ([7dabee5](https://code.castopod.org/adaures/castopod/commit/7dabee58a187abe92358d962da506a836e29cda3))

# [1.0.0-beta.21](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.20...v1.0.0-beta.21) (2022-09-06)

### Bug Fixes

- **email:** set the correct url in the activation and forgot emails
  ([10fc6f1](https://code.castopod.org/adaures/castopod/commit/10fc6f17c6838a58348f32ccfd0cf05f9d3e172c)),
  closes [#204](https://code.castopod.org/adaures/castopod/issues/204)
- **notifications:** add trigger after activities update + update insert trigger
  ([e5d16e8](https://code.castopod.org/adaures/castopod/commit/e5d16e87119021fa5a43470d67ddfe5128e57f74))

### Features

- **i18n:** add support for Simplified Chinese (zh-Hans) and Catalan (ca)
  locales
  ([48d1443](https://code.castopod.org/adaures/castopod/commit/48d14434727c3310a391160c7af02c56b7e20425))

# [1.0.0-beta.20](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.19...v1.0.0-beta.20) (2022-08-12)

### Bug Fixes

- add underline and semibold font weight for prose links to have them stand out
  ([d4d8671](https://code.castopod.org/adaures/castopod/commit/d4d867121c50bded4176a53d7154cf1bb347e306))
- **router:** check if Accept header is set before getting value
  ([10a2ae0](https://code.castopod.org/adaures/castopod/commit/10a2ae02484672d6a0fbc6e7b943519c5ec16cb6)),
  closes [#228](https://code.castopod.org/adaures/castopod/issues/228)
- **search-episodes:** add fallback sql query using LIKE for search query with
  less than 4 characters
  ([e66bf44](https://code.castopod.org/adaures/castopod/commit/e66bf44341175bc5a10fbf7dfa00b351e76136c2)),
  closes [#236](https://code.castopod.org/adaures/castopod/issues/236)
- set interact_as_actor for user upon password reset
  ([ad8f5f5](https://code.castopod.org/adaures/castopod/commit/ad8f5f5a0fac7b0b9cc10a0b86200f014aca7553)),
  closes [#178](https://code.castopod.org/adaures/castopod/issues/178)

### Features

- add label to sponsor button on podcast page
  ([c29c018](https://code.castopod.org/adaures/castopod/commit/c29c018c7a543fc9398b5d7d11f086123e2b33f2)),
  closes [#162](https://code.castopod.org/adaures/castopod/issues/162)
- add notifications inbox for actors
  ([999999e](https://code.castopod.org/adaures/castopod/commit/999999e3efab7b1aad7568e4fd114dc7bac04f38)),
  closes [#215](https://code.castopod.org/adaures/castopod/issues/215)

# [1.0.0-beta.19](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.18...v1.0.0-beta.19) (2022-07-21)

### Bug Fixes

- **episode-unpublish:** set consistent posts_counts' increments/decrements for
  actors and episodes
  ([8acdafd](https://code.castopod.org/adaures/castopod/commit/8acdafd26044e50a4d6ee451bf24ad66003c5bb3)),
  closes [#233](https://code.castopod.org/adaures/castopod/issues/233)
- **get_browser_language:** return defaultLocale if browser doesn't send user
  preferred language
  ([9cc2996](https://code.castopod.org/adaures/castopod/commit/9cc299626181048b85b629bbe7f5806a1f5d21ff))

### Features

- **episode-unpublish:** remove episode comments upon unpublish
  ([78acd7f](https://code.castopod.org/adaures/castopod/commit/78acd7f5c057c82507d801c424040296dbaba586))

# [1.0.0-beta.18](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.17...v1.0.0-beta.18) (2022-07-07)

### Bug Fixes

- **player-styling:** revert vite to 2.8 to reference the player css
  ([e07d3af](https://code.castopod.org/adaures/castopod/commit/e07d3afea9af85b8361227e000fb64b502781668))

### Features

- add legalNoticeURL to app config for setting an external url to legal notice
  ([711843a](https://code.castopod.org/adaures/castopod/commit/711843a0c81e1e2ec7a015431786df4ef32d5092))

# [1.0.0-beta.17](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.16...v1.0.0-beta.17) (2022-07-06)

### Bug Fixes

- explicitly cast seconds to int in iso8601_duration helper function
  ([779653f](https://code.castopod.org/adaures/castopod/commit/779653f75b140942f731cbb238bc0667cc461307))
- **housekeeping:** use EpisodeModel's builder to reset comments count
  ([65e9c0b](https://code.castopod.org/adaures/castopod/commit/65e9c0b05ea4992884149cb4a4b071bf31a20a1a))
- **rss:** round episode durations and soundbites
  ([c9fb987](https://code.castopod.org/adaures/castopod/commit/c9fb987fcfbe17069ec68fdbc823777079ce574b)),
  closes [#214](https://code.castopod.org/adaures/castopod/issues/214)
- **xml-editor:** prettify xml even without root node
  ([ca55c24](https://code.castopod.org/adaures/castopod/commit/ca55c248d0562a8529071c1f10be12f40ef50dda))

### Features

- add publish feature for podcasts and set draft by default
  ([3d363f2](https://code.castopod.org/adaures/castopod/commit/3d363f2efe99836ac05c305a2fa683e342f06561)),
  closes [#128](https://code.castopod.org/adaures/castopod/issues/128)
  [#220](https://code.castopod.org/adaures/castopod/issues/220)
- **admin:** add instance wide dashboard with storage and bandwidth usage
  ([b1a6c02](https://code.castopod.org/adaures/castopod/commit/b1a6c02e56fdc01a7ff69fa7e7dd8ea71380b7ba)),
  closes [#216](https://code.castopod.org/adaures/castopod/issues/216)
- **datetime-picker:** set material_green theme to flatpickr
  ([3ce6541](https://code.castopod.org/adaures/castopod/commit/3ce6541003260677e722a916ad6bc83ef47c4371))

# [1.0.0-beta.16](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.15...v1.0.0-beta.16) (2022-06-24)

### Bug Fixes

- change image size requirement hints
  ([ea20206](https://code.castopod.org/adaures/castopod/commit/ea20206ee674eb54dd3ea188d2a2e2d41425df65))

### Features

- add update rss feed feature for podcasts to import their latest episodes
  ([5eb9dc1](https://code.castopod.org/adaures/castopod/commit/5eb9dc168eb9af04767829b76242c9120f55d46d)),
  closes [#183](https://code.castopod.org/adaures/castopod/issues/183)
- **admin:** add search form in podcast episodes list
  ([6be5d12](https://code.castopod.org/adaures/castopod/commit/6be5d12877342a7c56e25ea8dd15a975c6ce45ac)),
  closes [#26](https://code.castopod.org/adaures/castopod/issues/26)
- **api:** add rest api with podcasts read endpoints
  ([e64001d](https://code.castopod.org/adaures/castopod/commit/e64001d00604bcf587ec5e9a631282f212df450d)),
  closes [#210](https://code.castopod.org/adaures/castopod/issues/210)

# [1.0.0-beta.15](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.14...v1.0.0-beta.15) (2022-06-14)

### Bug Fixes

- replace deletedField with published_at for episodes
  ([14d7d07](https://code.castopod.org/adaures/castopod/commit/14d7d078225cdc8980759273a5dc4163d9f84b06))

### Features

- add default icons to Alert component
  ([0d98001](https://code.castopod.org/adaures/castopod/commit/0d9800123b135e4fa1a2acd14a5e039c12174333))
- add permanent delete feature for podcasts 🎉
  ([dbb4030](https://code.castopod.org/adaures/castopod/commit/dbb4030da49f9ea1f61759fb7c66d71fc29ea4a1)),
  closes [#89](https://code.castopod.org/adaures/castopod/issues/89)
- apply colour theme to embed player
  ([9548337](https://code.castopod.org/adaures/castopod/commit/9548337a7c49879e8b58c2dfece46e3cfc9517eb)),
  closes [#201](https://code.castopod.org/adaures/castopod/issues/201)
- **episodes:** replace soft delete with permanent delete
  ([eb9ff52](https://code.castopod.org/adaures/castopod/commit/eb9ff522c25af8ceb2ed08614b581757ee791d42))

# [1.0.0-beta.14](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.13...v1.0.0-beta.14) (2022-04-23)

### Bug Fixes

- **home:** remove hardcoded prefix in getAllPodcasts query
  ([92d5cc5](https://code.castopod.org/adaures/castopod/commit/92d5cc50a3e533875cd894dccc417918102d4b7f))
- overwrite common lang function to escape returned string
  ([4c490c1](https://code.castopod.org/adaures/castopod/commit/4c490c15bb6642ad0b2aaddf08d8af25de99b4b0)),
  closes [#196](https://code.castopod.org/adaures/castopod/issues/196)
  [#198](https://code.castopod.org/adaures/castopod/issues/198)

### Features

- **i18n:** add Spanish to supported locales
  ([e340b54](https://code.castopod.org/adaures/castopod/commit/e340b54a84d7dcdf9ba910fe7ff39c453fac0968))

# [1.0.0-beta.13](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.12...v1.0.0-beta.13) (2022-04-14)

### Bug Fixes

- **rss:** remove escaping for publisher and owner name
  ([e2046e4](https://code.castopod.org/adaures/castopod/commit/e2046e4b116ecddb5e6d68487f666b95fd7f493c))
- use UTC_TIMESTAMP() to get current utc date instead of NOW() in sql queries
  ([853a6ba](https://code.castopod.org/adaures/castopod/commit/853a6ba9155b6687604304d59f03d0efb75a9f96))

### Features

- **i18n:** add Norwegian Nynorsk to supported locales
  ([744340d](https://code.castopod.org/adaures/castopod/commit/744340df615bee38a54c4abbbb7f03d51b61a39d))

# [1.0.0-beta.12](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.11...v1.0.0-beta.12) (2022-04-05)

### Bug Fixes

- update form_textarea to prevent escaping value
  ([78548b5](https://code.castopod.org/adaures/castopod/commit/78548b5cd75ea7d6688d1945ff5449ea4f6bec68))

### Features

- **i18n:** add support for German and Brazilian Portuguese languages
  ([19da003](https://code.castopod.org/adaures/castopod/commit/19da003fd396bff20b89ad330b787e9cdbe8d919))

# [1.0.0-beta.11](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.10...v1.0.0-beta.11) (2022-04-01)

### Bug Fixes

- change message upon cancellation of episode publication
  ([9859c74](https://code.castopod.org/adaures/castopod/commit/9859c7434c2a3478ce035f7a4de20f594d63f5b0))
- prefill description footer input when creating a new episode
  ([9ea5ca3](https://code.castopod.org/adaures/castopod/commit/9ea5ca31697c70d176294f8aea37bd57d471fcf7))
- remove value escaping for form inputs and textareas
  ([bc6dea2](https://code.castopod.org/adaures/castopod/commit/bc6dea2f8ad1cf0aee0eaa93151332fbac7fb771))
- restore default podcast icon on public website
  ([342778b](https://code.castopod.org/adaures/castopod/commit/342778bac3c684328d72633961df1a2ebdc1330e))
- **socialinteract:** move social interact uri into uri attribute + update
  social data upon import
  ([12b2200](https://code.castopod.org/adaures/castopod/commit/12b22008a237185cb736fc29352fab22421dad16))

### Features

- **analytics-gdpr:** update cached personal data to expire at midnight
  ([0188b67](https://code.castopod.org/adaures/castopod/commit/0188b67354a756f0c926edd7b46623ab5b20c12b))
- **analytics:** add current date and secret salt to analytics hash for improved
  privacy
  ([6f2e7c0](https://code.castopod.org/adaures/castopod/commit/6f2e7c009c24830d4f08633bfbde3b75f40bf215))
- **i18n:** add 7 new languages + update german translations
  ([d021abb](https://code.castopod.org/adaures/castopod/commit/d021abb52f5525d93810e25df2b453c918d7bc8b))
- **i18n:** add german language as supported locale + create Language files from
  english source
  ([c220b31](https://code.castopod.org/adaures/castopod/commit/c220b310ed59cad188af044b1fed0c39efc7da5b))
- **icons:** add podnews icon to podcasting platforms
  ([5f42355](https://code.castopod.org/adaures/castopod/commit/5f423557c2b78fd7c38c5e0caab6c6c80d21e36e)),
  closes [#190](https://code.castopod.org/adaures/castopod/issues/190)

# [1.0.0-beta.10](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.9...v1.0.0-beta.10) (2022-03-15)

### Bug Fixes

- add explicit int conversion when formatting episode duration
  ([1253096](https://code.castopod.org/adaures/castopod/commit/1253096197a0d30692bdafa7152f250cd9a71acf))
- add href to castopod website on login page
  ([cc54257](https://code.castopod.org/adaures/castopod/commit/cc5425735184ad738aa0f38540f18e8971f8f56e))
- move html escaping on credits page
  ([fbffdbd](https://code.castopod.org/adaures/castopod/commit/fbffdbde78544c83138ee6234c62d43056f407b6))
- remove cache from remote follow form to display error messages
  ([90e4443](https://code.castopod.org/adaures/castopod/commit/90e44437bdf37d8024ef609b2f7336dbdfc3b974))

### Features

- add autofocus to input field "Email or username" on login page
  ([19caed4](https://code.castopod.org/adaures/castopod/commit/19caed4bce0daab9ccf6ab9645f44b60eb87de88))
- add WebSub module for pushing feed updates to open hubs
  ([10d3f73](https://code.castopod.org/adaures/castopod/commit/10d3f73786ba141e27a822b2585c4a244ee92c14))
- **GDPR:** add GDPR.yml file to public/.well-known/
  ([86bccc3](https://code.castopod.org/adaures/castopod/commit/86bccc3d5cc9562b89196f1766ac91cdc8ad786d))

# [1.0.0-beta.9](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.8...v1.0.0-beta.9) (2022-03-04)

### Bug Fixes

- **cache:** delete posts and comments pages cache when updating platform links
  ([f7c3e5b](https://code.castopod.org/adaures/castopod/commit/f7c3e5bf4ad43389bf8d58d2c4aaf16b81cbce00)),
  closes [#169](https://code.castopod.org/adaures/castopod/issues/169)
- escape characters for `min` in format_duration_symbol
  ([3b6722a](https://code.castopod.org/adaures/castopod/commit/3b6722a42b9e4330e5235d4ceed41c777159f4dc))
- **security:** add csrf filter + prevent xss attacks by escaping user input
  ([cd2e1e1](https://code.castopod.org/adaures/castopod/commit/cd2e1e1dc37c53d32d00971c451c4800b8fd6107))
- update ivoox podcasting icon
  ([f2b69a4](https://code.castopod.org/adaures/castopod/commit/f2b69a47339c887f57883ec612f3d200e512ac1c))
- **video-clips:** update condition to check if ffmpeg is installed
  ([b57f0b6](https://code.castopod.org/adaures/castopod/commit/b57f0b6eb65dccf22cb4d55f93d18ca36857d7fc)),
  closes [#163](https://code.castopod.org/adaures/castopod/issues/163)

### Features

- **i18n:** add Polish translation
  ([2d83b44](https://code.castopod.org/adaures/castopod/commit/2d83b44add9e4e00766a1f326377ed892f48ad73))
- **icons:** add default icons for podcasting, social and funding platforms +
  remove complex icons
  ([5bcdfeb](https://code.castopod.org/adaures/castopod/commit/5bcdfebe6489b5d6b90f3c828b014ec4e9a7e7e1)),
  closes [#166](https://code.castopod.org/adaures/castopod/issues/166)
  [#167](https://code.castopod.org/adaures/castopod/issues/167)
  [#170](https://code.castopod.org/adaures/castopod/issues/170)
- make episode description more visible on episode pages
  ([90533be](https://code.castopod.org/adaures/castopod/commit/90533be0298249e5527870c01329fce5f94ec2dc)),
  closes [#171](https://code.castopod.org/adaures/castopod/issues/171)
- **podcasting 2.0:** update podcast:social tag to adhere to latest spec
  ([a597cf4](https://code.castopod.org/adaures/castopod/commit/a597cf4ecfa6807a3413177d99c816056a7e7c45))

# [1.0.0-beta.8](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.7...v1.0.0-beta.8) (2022-02-10)

### Features

- **podcast-form:** add new_feed_url field to set an url when changing domain or
  host
  ([e7eec48](https://code.castopod.org/adaures/castopod/commit/e7eec48e7bc06a9aa907db01ed3e5b536e7dd8be))

# [1.0.0-beta.7](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.6...v1.0.0-beta.7) (2022-02-05)

### Bug Fixes

- **activitypub:** allow cors on get requests for routes exposing activitypub
  objects
  ([2f24809](https://code.castopod.org/adaures/castopod/commit/2f2480998f9abb34f02ab186c65d462a74b4e640))
- **fediverse:** set model instances as non shared to prevent overlapping
  ([91128fa](https://code.castopod.org/adaures/castopod/commit/91128fad7a68e1f4e5acacba90b6899288699e61))
- **htaccess:** add ? after index.php in RewriteRule
  ([d9d139e](https://code.castopod.org/adaures/castopod/commit/d9d139eefa03c28d1a064b3b32c9036193497e57)),
  closes [#152](https://code.castopod.org/adaures/castopod/issues/152)

### Features

- **home:** sort podcasts by recent activity + add dropdown menu to choose
  between sorting options
  ([7b89da6](https://code.castopod.org/adaures/castopod/commit/7b89da6106c150708782d39ed2742fe416c41e89)),
  closes [#164](https://code.castopod.org/adaures/castopod/issues/164)

# [1.0.0-beta.6](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.5...v1.0.0-beta.6) (2022-02-03)

### Bug Fixes

- **activitypub:** add conditions for possibly missing actor properties + add
  user-agent to requests
  ([8fbf948](https://code.castopod.org/adaures/castopod/commit/8fbf948fbba22ffd33966a1b2ccd42e8f7c1f8a2))
- **activitypub:** add target actor id to like / announce activities to send
  directly to note's actor
  ([962dd30](https://code.castopod.org/adaures/castopod/commit/962dd305f5d3f6eadc68f400e0e8f953827fe20d))
- **activitypub:** add target_actor_id for create activity to broadcast post
  reply
  ([0128a21](https://code.castopod.org/adaures/castopod/commit/0128a21ec55dcc0a2fbf4081dadb4c4737735ba1))
- **http-signature:** update SIGNATURE_PATTERN allowing signature keys to be
  sent in any order
  ([b7f285e](https://code.castopod.org/adaures/castopod/commit/b7f285e4e24247fedb94f030356fa6f291f525cc))
- **install:** set message block on forms to show error messages
  ([3a0a20d](https://code.castopod.org/adaures/castopod/commit/3a0a20d59cdae7f166325efb750eaa6e9800ba6e)),
  closes [#157](https://code.castopod.org/adaures/castopod/issues/157)
- **markdown-editor:** remove unnecessary buttons for podcast and episode
  editors + add extensions
  ([9c4f60e](https://code.castopod.org/adaures/castopod/commit/9c4f60e00bcbd4f784f12d2a6fed357ad402ee2e))
- **podcast-activity:** check if transcript and chapters are set before
  including them in audio
  ([5855a25](https://code.castopod.org/adaures/castopod/commit/5855a250936f91641efef77650890a18d8e9917f))
- **podcast:** use markdown description value for editor + set prose class to
  about description
  ([f304d97](https://code.castopod.org/adaures/castopod/commit/f304d97b14e0ef383509cb3bba50beb55bf701ba)),
  closes [#156](https://code.castopod.org/adaures/castopod/issues/156)

# [1.0.0-beta.5](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.4...v1.0.0-beta.5) (2022-01-31)

### Bug Fixes

- **analytics:** set initial value for duration and bandwidth
  ([ee50539](https://code.castopod.org/adaures/castopod/commit/ee5053959154b1a2e5fbe4b43162968425206a26))

# [1.0.0-beta.4](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.3...v1.0.0-beta.4) (2022-01-29)

### Bug Fixes

- **housekeeping:** replace the use of GLOB_BRACE with looping over file
  extensions
  ([42d92d0](https://code.castopod.org/adaures/castopod/commit/42d92d0c8dfe0c567c28f5bfdda129890fa4c2ec)),
  closes [#154](https://code.castopod.org/adaures/castopod/issues/154)
- **housekeeping:** set default sizes value + ignore illegal IFD size error to
  proceed with script
  ([f21ca57](https://code.castopod.org/adaures/castopod/commit/f21ca57603cfa503699b7e09a155e18d876d65fe))

### Features

- **housekeeping:** add clear_cache option to flush redis or files cache
  ([99bfac0](https://code.castopod.org/adaures/castopod/commit/99bfac0b428a4bc6fe8bfd10a355dfd93f42ba5c))

# [1.0.0-beta.3](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.2...v1.0.0-beta.3) (2022-01-28)

### Bug Fixes

- revert to beta.1's codeigniter4 version
  ([e831411](https://code.castopod.org/adaures/castopod/commit/e83141127080ccde44987195db46ba97fd6cc2ca))

# [1.0.0-beta.2](https://code.castopod.org/adaures/castopod/compare/v1.0.0-beta.1...v1.0.0-beta.2) (2022-01-28)

### Bug Fixes

- **migrations:** ignore invalid utf8 chars for media files metadata + update
  transcript parser
  ([45e8f99](https://code.castopod.org/adaures/castopod/commit/45e8f99e753cc02ec105e6f4d7fe026a205724f8))
- **video-clips:** set audio codec to aac, fixing audio issue on twitter
  ([3c22c68](https://code.castopod.org/adaures/castopod/commit/3c22c68ee81f77bd7fcf7e2739ee6af016407843))
- **video-clips:** set longer podcast and episode lengths for squared format
  ([c030113](https://code.castopod.org/adaures/castopod/commit/c0301134c2048dc29eb2b995e4d5c22c49444100))

# 1.0.0-beta.1 (2022-01-23)

### Bug Fixes

- **a11y:** replace active tab color to contrast with background on podcast and
  episode pages
  ([f3785e1](https://code.castopod.org/adaures/castopod/commit/f3785e140147d085a2fb6a62ded87cdfe360f442))
- **activity-pub:** cache issues when navigating to activity stream urls
  ([7bcbfb3](https://code.castopod.org/adaures/castopod/commit/7bcbfb32f7cca08d111be46c7f1640e372d4a4b0))
- **activity-pub:** get database records using new model instances
  ([92536dd](https://code.castopod.org/adaures/castopod/commit/92536ddb3812214a9c5682b92e547e5c1998a5d7))
- **activitypub:** set created_by to null for reblog if no user + update episode
  oembed data
  ([209dfbd](https://code.castopod.org/adaures/castopod/commit/209dfbd134e1a2cc02e7c24c158d786fa4dda61d))
- add admin-audio-player to vite config to have admin player show up
  ([93cb9b2](https://code.castopod.org/adaures/castopod/commit/93cb9b24701c09b92820204a67c1fc1b3c044708))
- add application/octet-stream mimetype to mp3 and m4a extensions to prevent
  ext_in error
  ([339bef8](https://code.castopod.org/adaures/castopod/commit/339bef878e54983d86e91e6ff7a931a843d321b3)),
  closes [#145](https://code.castopod.org/adaures/castopod/issues/145)
- add category_label component to include parent category in about podcast page
  ([74e7d68](https://code.castopod.org/adaures/castopod/commit/74e7d68ac834885c4b89ee6e7d60db2157165799))
- add head request to analytics_hit route
  ([f0a2f0b](https://code.castopod.org/adaures/castopod/commit/f0a2f0bea491ca91976b351bb79837e95c9d094b))
- add missing explicit badge for podcasts and episodes
  ([cdf9f9d](https://code.castopod.org/adaures/castopod/commit/cdf9f9d53f2597f19455cb65c51da4677bb99327))
- add open graph size for podcast images to replace the inadequate large format
  ([33aae1f](https://code.castopod.org/adaures/castopod/commit/33aae1f7934e4962116e94e477dbf48e24971f5f))
- add public/media folder to castopod bundle
  ([8053d35](https://code.castopod.org/adaures/castopod/commit/8053d3521b481872711dabaaf265d08b9bfbaa87)),
  closes [#52](https://code.castopod.org/adaures/castopod/issues/52)
- add translation key for audio-clipper trim labels
  ([db191ac](https://code.castopod.org/adaures/castopod/commit/db191ac31bd16bad2a72afdb8b25c685adf86a6e))
- add where condition to get episode count without deleted episodes
  ([7661734](https://code.castopod.org/adaures/castopod/commit/7661734ed296654630f3668132671117519145dd)),
  closes [#67](https://code.castopod.org/adaures/castopod/issues/67)
- **admin:** save block and lock switches
  ([b66c0af](https://code.castopod.org/adaures/castopod/commit/b66c0afc8fab2e338402a9a4f8105e5f5459e208))
- **analytics:** redirect to mp3 file even when referer was not set
  ([9fc388d](https://code.castopod.org/adaures/castopod/commit/9fc388d154f29c335dedcd624abe8c1751762c07))
- **analytics:** remove charts empty values + remove useless language cache
  ([1678794](https://code.castopod.org/adaures/castopod/commit/16787941539ba4014281a366789ea896a9cd2afc))
- **analytics:** set duration field to precise decimal as episode's audio file
  duration
  ([d772685](https://code.castopod.org/adaures/castopod/commit/d77268540569b2be9d91d5e09aefb3ff5ac2b071))
- **analytics:** update migrations to set decimal precision for latitude and
  longitude
  ([714d6b5](https://code.castopod.org/adaures/castopod/commit/714d6b5d4950e52cf1c3170bb59954f98ffd48bd))
- **analytics:** update service management so that it works with new OPAWG slug
  values
  ([7fe9d42](https://code.castopod.org/adaures/castopod/commit/7fe9d42500ade2c6fa3ff4365b4affc475af0e51))
- **audio-clipper:** add mouse position offset when stretching clip to prevent
  content from jumping
  ([602654b](https://code.castopod.org/adaures/castopod/commit/602654b99b33ee8c29da080058a0aaea976cd484))
- **audio-clipper:** show audio playing progress + put waveform behind audio
  clipper
  ([01a09dc](https://code.castopod.org/adaures/castopod/commit/01a09dc447b81c5412ceb45d6706a867939fd4dd))
- **avatar:** use default avatar when no avatar url has been set
  ([9d23c7e](https://code.castopod.org/adaures/castopod/commit/9d23c7e7e142c6cf1a1418e37e41d711064593c4)),
  closes [#111](https://code.castopod.org/adaures/castopod/issues/111)
- **bundle:** include modules and themes when copying files with rsync
  ([cd5bb88](https://code.castopod.org/adaures/castopod/commit/cd5bb8835c6e259408a8c13a2196a347e161da83))
- **bundle:** update vite input files path + add `set -e` in bash scripts to
  fail if command fails
  ([0ee53c7](https://code.castopod.org/adaures/castopod/commit/0ee53c71ffadb8a6ddb1febd9f912bc99f5f7a0b))
- **cache:** add locale for podcast and episode pages + clear some persisting
  cache in models
  ([9cec8a8](https://code.castopod.org/adaures/castopod/commit/9cec8a81ccbb7239402fe6633dbc31979272302a)),
  closes [#42](https://code.castopod.org/adaures/castopod/issues/42)
  [#61](https://code.castopod.org/adaures/castopod/issues/61)
- **cache:** return a non cached view when connected
  ([e2e7358](https://code.castopod.org/adaures/castopod/commit/e2e735815d805a48eed2ea3288d060d0ddb253a3))
- **cache:** suffix cache names with authenticated for credits, map and pages
  ([418a70b](https://code.castopod.org/adaures/castopod/commit/418a70b2a670d8ba0ab6c15fa5faa41f6be55e53))
- cast actor_id to pass as int to set_interact_as_actor() function
  ([56a8e5d](https://code.castopod.org/adaures/castopod/commit/56a8e5d7dd615322aeb007e730801c65d0b02e5c))
- **category:** remove uncategorized option to enforce users in choosing a
  category
  ([8c64f25](https://code.castopod.org/adaures/castopod/commit/8c64f25a0e72fec03d25544797d32623b2276fce))
- check for database connection and podcasts table existence before redirecting
  to install
  ([eb74e81](https://code.castopod.org/adaures/castopod/commit/eb74e81c3d93581e310b391cd029e62a0d690a8a))
- check that additional files are valid when creating episode
  ([eac5bc8](https://code.castopod.org/adaures/castopod/commit/eac5bc876de125e1fe08d1b89f767a04fc0fbfb6))
- check that note has a preview_card_id before displaying it
  ([acb8b3a](https://code.castopod.org/adaures/castopod/commit/acb8b3a40172ccb184ffe544760601d756692e6c)),
  closes [#114](https://code.castopod.org/adaures/castopod/issues/114)
- clear cache when deleting podcast banner
  ([99bb40b](https://code.castopod.org/adaures/castopod/commit/99bb40b8bc17b8ee2cd8468a82e46ea280c92cb6))
- comment all cache clean after page update to prevent analytics cache deletion
  ([e6197a4](https://code.castopod.org/adaures/castopod/commit/e6197a4972a3cce3d67dd7972bb54f8720b8e5b7))
- **comments:** add comment view partials for public pages
  ([fcecbe1](https://code.castopod.org/adaures/castopod/commit/fcecbe1c68b0d28d19454fba65caf3ab769fbc75))
- correct chart data
  ([4d3e9c8](https://code.castopod.org/adaures/castopod/commit/4d3e9c8c02cdc882e9fe1c29625695b6f83c820a))
- correct percona compatibility issue
  ([e53f819](https://code.castopod.org/adaures/castopod/commit/e53f819264b2d6902996f11ffcbb7c99295a90ef))
- correct php-fpm issues
  ([1ef55d7](https://code.castopod.org/adaures/castopod/commit/1ef55d7315bb44abe05f02ec8a84b6b6a557a9a0))
- correct referrer bug
  ([ed69b2f](https://code.castopod.org/adaures/castopod/commit/ed69b2f5004ed1cd18bac824c08a0df01f5d2637))
- correction for servers with low int precision
  ([31b7828](https://code.castopod.org/adaures/castopod/commit/31b7828e77519ef43e9bcfcbdf6c21712f97a571))
- **cors:** add preflight option routes for episode, podcast and status objects
  ([a281abf](https://code.castopod.org/adaures/castopod/commit/a281abfda475388a07943c169dab460cc2d4f944))
- declare typed properties in PHPDoc for php<7.4
  ([14dd44d](https://code.castopod.org/adaures/castopod/commit/14dd44d03d6db0d9ae4198db8e65c92a0e45cb31)),
  closes [#23](https://code.castopod.org/adaures/castopod/issues/23)
- define podcast_id and platform_slug as foreign keys in podcasts_platforms table
  ([6e9451a](https://code.castopod.org/adaures/castopod/commit/6e9451a1103b43750fa70ad576de36af25ca29cb))
- define podcastNamespaceLink value
  ([0d744d2](https://code.castopod.org/adaures/castopod/commit/0d744d212df0d070ceea185068eaf2746e1ccd48))
- **embeddable-player:** enable any ancestor when X-Frame-Options is set on
  server
  ([44a4962](https://code.castopod.org/adaures/castopod/commit/44a4962e0b7e3ed87e9914b4e7792a0d52330ff8))
- **embed:** open embedded player's links in new tab
  ([4aa73d7](https://code.castopod.org/adaures/castopod/commit/4aa73d71e3b8c0a6c3f75f4d1d45c4d693aba64c))
- **episode-form:** show warning to set `memory_limit`, `upload_max_filesize` &
  `post_max_size`
  ([3b3c218](https://code.castopod.org/adaures/castopod/commit/3b3c218b9c868e9f12c54d7670e69d84c9ee79c0)),
  closes [#5](https://code.castopod.org/adaures/castopod/issues/5)
  [#86](https://code.castopod.org/adaures/castopod/issues/86)
- **episodeCount:** add missing brackets to French language file
  ([c1b4112](https://code.castopod.org/adaures/castopod/commit/c1b411265ad9b06e95a8b097ecf73445b88dcb45))
- **episode:** replace guid's empty string value to null
  ([441052a](https://code.castopod.org/adaures/castopod/commit/441052af8d99e6e317edefd1e58ad71799357088))
- **episodes-page:** handle defaultQuery being null when no podcast episodes
  ([15183b7](https://code.castopod.org/adaures/castopod/commit/15183b7eab57dac007bcdfa8c3651239de1ae05a)),
  closes [#100](https://code.castopod.org/adaures/castopod/issues/100)
- **episodes-table:** set descriptions to be not null
  ([6774ec1](https://code.castopod.org/adaures/castopod/commit/6774ec10fa78527be6b7548ca1dc34ad0ada090c))
- **episodes:** add publication status + set publication date to null when none
  has been set
  ([d882981](https://code.castopod.org/adaures/castopod/commit/d882981b3a86c81921ce6b07d4cf61fc13983689)),
  closes [#70](https://code.castopod.org/adaures/castopod/issues/70)
- escape generated feed tag values and remove new lines from public pages meta
  description
  ([6238a43](https://code.castopod.org/adaures/castopod/commit/6238a43863210afe8988ad7cf251e6bfc6c8557c)),
  closes [#57](https://code.castopod.org/adaures/castopod/issues/57)
  [#46](https://code.castopod.org/adaures/castopod/issues/46)
- expire default query cache upon scheduled episode publication
  ([b72e7c8](https://code.castopod.org/adaures/castopod/commit/b72e7c8691c887e41107baea0a4d50a39eaf8c8b)),
  closes [#81](https://code.castopod.org/adaures/castopod/issues/81)
- fix layout bugs in admin and update translation files
  ([a834171](https://code.castopod.org/adaures/castopod/commit/a83417180cf61cdfadc5509b0aaa2fdb66592be3)),
  closes [#40](https://code.castopod.org/adaures/castopod/issues/40)
- **follow:** add missing helpers to Actor controller
  ([ee53a73](https://code.castopod.org/adaures/castopod/commit/ee53a732dc12ebbf5706e14969749a12cfd9d559))
- handle HEAD requests on podcast_feed route
  ([74b2640](https://code.castopod.org/adaures/castopod/commit/74b2640f2a25c4cd6fd8835fc492c2a6893d4950)),
  closes [#79](https://code.castopod.org/adaures/castopod/issues/79)
- **images:** set default mimetype if none is specified when getting size info
  ([6e4acc6](https://code.castopod.org/adaures/castopod/commit/6e4acc64ad256178cee7905402b48bafcd49f84c))
- **import-with-escaped-characters:** remove \CodeIgniter\HTTP\URI in
  download_file, closes
  [#103](https://code.castopod.org/adaures/castopod/issues/103)
  ([35b5be0](https://code.castopod.org/adaures/castopod/commit/35b5be095ff54d27acec1610a846ec0cdbdf1d65))
- **import:** add extension when downloading file without + truncate slug if too
  long
  ([c5f18bb](https://code.castopod.org/adaures/castopod/commit/c5f18bb6dc08a758ff735454bbe9cfa45a68c09b))
- **import:** add validation for handle field to prevent
  Router.invalidParameterType error
  ([5bf7200](https://code.castopod.org/adaures/castopod/commit/5bf7200fb390f2447b29f24b495f24483cf7b205)),
  closes [#119](https://code.castopod.org/adaures/castopod/issues/119)
- **import:** cast description's SimpleXMLElement to string
  ([02d17be](https://code.castopod.org/adaures/castopod/commit/02d17be4ffe229fc6657207d31eba0543b5f1a4c))
- **import:** remove query string from files url
  ([109c4aa](https://code.castopod.org/adaures/castopod/commit/109c4aa1afb72dd8b99c0302d74a7fef5a38638e))
- **import:** save media files during podcast import + set missing media fields
  ([a9989d8](https://code.castopod.org/adaures/castopod/commit/a9989d841a634f8cf6c04df25f40bb1e7d4fcdcc))
- **import:** set episode and season numbers to null when not present in item
  tag
  ([3211398](https://code.castopod.org/adaures/castopod/commit/3211398c78b1b28b76a46427ee07874bbf84a85d))
- **import:** use <image><url> tag when no <itunes:image> is present
  ([20e607a](https://code.castopod.org/adaures/castopod/commit/20e607afb755bc75056041738fa7cbf6723d754c))
- include missing variables on public ui's episode page and remote_actions
  ([193b373](https://code.castopod.org/adaures/castopod/commit/193b373bc94a5270acae99b637aa84b6cb2dedfe))
- **install:** redirect manually to install wizard on first visit
  ([2ceaaca](https://code.castopod.org/adaures/castopod/commit/2ceaaca44f1b82fc64d961e2fb4f4aaeade7e736))
- **install:** redirect to host_url install route on instanceConfig validation
  error
  ([99250b1](https://code.castopod.org/adaures/castopod/commit/99250b1868657c249a447399c7ebc69e00d43d1a))
- **install:** redirect to input baseUrl after instance config
  ([2426af7](https://code.castopod.org/adaures/castopod/commit/2426af7de8c9d426aaf534ff17b67f71c2e9f374)),
  closes [#53](https://code.castopod.org/adaures/castopod/issues/53)
- **interact-as:** set actor_id instead of podcast id upon login event
  ([5dfade7](https://code.castopod.org/adaures/castopod/commit/5dfade7cf37f339c56d2e577c679b88a1b1d9336)),
  closes [#104](https://code.castopod.org/adaures/castopod/issues/104)
- **json-ld:** add missing properties to PodcastSeries object
  ([e97266c](https://code.castopod.org/adaures/castopod/commit/e97266c5d4883a10f68b3685ecc0d1942f54d658))
- keep subtitle line breaks when parsing srt file to json
  ([cfb3da6](https://code.castopod.org/adaures/castopod/commit/cfb3da6592f2de23cb1a7ac420f19fc77fa338aa))
- **layouts:** replace holy-grail layout with tailwind config + widen public
  podcast layout
  ([be5a287](https://code.castopod.org/adaures/castopod/commit/be5a28787fdb180b64d9bf570120eff7072ab9aa))
- **map:** update episode markers query to discard unpublished episodes
  ([b3caac4](https://code.castopod.org/adaures/castopod/commit/b3caac45b12a23e4289d00133d2ad7915d084c44))
- **md-editor:** build new markdown editor with lit +
  github/markdown-toolbar-element
  ([9ec1cb9](https://code.castopod.org/adaures/castopod/commit/9ec1cb93da6f41124c48b8cf14ee6942e865bede)),
  closes [#93](https://code.castopod.org/adaures/castopod/issues/93)
  [#94](https://code.castopod.org/adaures/castopod/issues/94)
  [#120](https://code.castopod.org/adaures/castopod/issues/120)
- minor corrections
  ([13be386](https://code.castopod.org/adaures/castopod/commit/13be386842e94d9def1f7de4720931d8f6935171))
- move analytics to helper
  ([d311917](https://code.castopod.org/adaures/castopod/commit/d31191732e41aa106234b5ebe6e54ee02f0ce603))
- **multiselect:** add missing class names in choices options for purge to work
  properly
  ([719538d](https://code.castopod.org/adaures/castopod/commit/719538d0ccb28af3c3c5e1a4b6468d4b772fe819))
- **open-graph:** replace non existant episode description to podcast
  description in podcast page
  ([b02584e](https://code.castopod.org/adaures/castopod/commit/b02584ee609af1ad1b5680cc28208d113eb0410b))
- **package.json:** update destination of postcss generation scripts
  ([21413f8](https://code.castopod.org/adaures/castopod/commit/21413f8af3b8a0ac01d8c6f15bcd7a63e524e964))
- **pages:** add locale to page cache
  ([8f999ce](https://code.castopod.org/adaures/castopod/commit/8f999ce2f7ee1416c30cf58c84f67b3d11b3f142))
- **partner:** set correct image URL
  ([61554be](https://code.castopod.org/adaures/castopod/commit/61554be12a64d59ab99fab810b1b05632b408f3a))
- pass timezone to relative time component to show the localized time in the UI
  ([b9db936](https://code.castopod.org/adaures/castopod/commit/b9db936461d4cb914958bb3256bb910bbd7ba815))
- **persons:** prevent overflow of persons list by adding horizontal scroll
  ([9e8995d](https://code.castopod.org/adaures/castopod/commit/9e8995dc6e039032cc65f87895cf770f99e8b244))
- **persons:** set person picture as optional for better ux
  ([7fdea63](https://code.castopod.org/adaures/castopod/commit/7fdea63de7e572810082c84fff3013af580df58b)),
  closes [#125](https://code.castopod.org/adaures/castopod/issues/125)
- **platforms:** display platform link only when visible is toggled on
  ([6e503c8](https://code.castopod.org/adaures/castopod/commit/6e503c8d6182987e48892370623183f871bbd1c1)),
  closes [#39](https://code.castopod.org/adaures/castopod/issues/39)
- **podcast-import:** move guid attribute declaration for Episode entity to
  include slug data
  ([5d02ae3](https://code.castopod.org/adaures/castopod/commit/5d02ae39908a9d743627135b372bf981134c4328))
- **pwa:** add scope to webmanifests to allow installing an app per podcast
  ([74c683e](https://code.castopod.org/adaures/castopod/commit/74c683eb44398a84443ec17903c3e002bb5ea9b9))
- **pwa:** set app display as standalone in the webmanifests
  ([7aa37d2](https://code.castopod.org/adaures/castopod/commit/7aa37d24ac13a1ee160c01a56b43621d7efcfbbc))
- re-order graph values
  ([35f633b](https://code.castopod.org/adaures/castopod/commit/35f633b4c71c087d1ddc9bba9e9bbe18de09204f))
- redirect to non cached views when authenticated in public views
  ([482b47b](https://code.castopod.org/adaures/castopod/commit/482b47ba6bdab7f27fc5704a559567228e07cd14))
- **release:** add missing version number to castopod-host package
  ([8f3e9d9](https://code.castopod.org/adaures/castopod/commit/8f3e9d90c14545d3f84d4469b26a53db4554b4dc))
- remove defer from js script declaration as it is a module
  ([18ae557](https://code.castopod.org/adaures/castopod/commit/18ae557e97f1cef775cd1e75fb1fedee7f1c0cc9))
- remove fixed size from podcast sidebar + rearrange account info + space out
  import radio inputs
  ([776eec6](https://code.castopod.org/adaures/castopod/commit/776eec6f0d533d6c92ebec16f7a9dbfcde1f41f4))
- remove required for other_categories field and add podcast_id to latest
  podcasts query
  ([5417be0](https://code.castopod.org/adaures/castopod/commit/5417be0049288489a19c7b575aa77bd1e2bc0243))
- remove required property to persons picture
  ([c546be3](https://code.castopod.org/adaures/castopod/commit/c546be385b243014243ae93356006cd126d2f00d)),
  closes [#125](https://code.castopod.org/adaures/castopod/issues/125)
- rename field status to task_status to get scheduled activities
  ([4ff82a5](https://code.castopod.org/adaures/castopod/commit/4ff82a5f0a38dbbc9e272fca7df70ea5a190e334))
- rename issue_templates labels
  ([9f00305](https://code.castopod.org/adaures/castopod/commit/9f00305844e5a168e89d727fe29892b4ad5e48d6))
- rename MyAccount controller file
  ([e109df3](https://code.castopod.org/adaures/castopod/commit/e109df3004a3a98d72de39532e062fff9917f50f)),
  closes [#60](https://code.castopod.org/adaures/castopod/issues/60)
- rename podcast name to podcast handle to clarify field usage
  ([9dd4c77](https://code.castopod.org/adaures/castopod/commit/9dd4c7741eb1b7cb5fc214ff674697f3aa986df0)),
  closes [#126](https://code.castopod.org/adaures/castopod/issues/126)
- reorder fields as composite primary keys for analytics tables
  ([9660aa9](https://code.castopod.org/adaures/castopod/commit/9660aa97c8ffd4fe61f3a388d52b9ac5dd8e1d63))
- replace getWebEnclosureUrl with getEnclosureWebUrl
  ([8122cea](https://code.castopod.org/adaures/castopod/commit/8122ceaf8a70050f14b3078f28b024e7d7cdb9ac))
- replace hardcoded style links with vite service + set default value for remote
  transcript url
  ([3f2e056](https://code.castopod.org/adaures/castopod/commit/3f2e05608e43d47bbb518a9acfaf56ec3eefafb4)),
  closes [#149](https://code.castopod.org/adaures/castopod/issues/149)
  [#150](https://code.castopod.org/adaures/castopod/issues/150)
- replace website key for webpages in breadcrumb translate file
  ([50e32ff](https://code.castopod.org/adaures/castopod/commit/50e32ff75636c1d4c5d945a267e884cb26ad7191))
- rewrite regenerate image function to use saveSizes method from Image entity
  ([3889912](https://code.castopod.org/adaures/castopod/commit/38899124ec27e94a8c798bc2db528f9f785eec20))
- **rss-import:** add Castopod user-agent, handle redirects for downloaded
  files, add Content namespace
  ([214243b](https://code.castopod.org/adaures/castopod/commit/214243b3fec4937e45ef1ceaba1149004cdf3b44))
- **rss:** cast number type values to string in rss_helper
  ([7180ae9](https://code.castopod.org/adaures/castopod/commit/7180ae9ec700930b69c04ed91f8eceea16ad77ce)),
  closes [#148](https://code.castopod.org/adaures/castopod/issues/148)
- **rss:** do not escape podcast and episode titles in the xml
  ([0dd3b7e](https://code.castopod.org/adaures/castopod/commit/0dd3b7e0bf00d5a9eb80c93cba1efcada59ec3c1)),
  closes [#138](https://code.castopod.org/adaures/castopod/issues/138)
  [#71](https://code.castopod.org/adaures/castopod/issues/71)
- **rss:** set ❬itunes:author❭ tag to owner_name if publisher not specified
  ([2271c14](https://code.castopod.org/adaures/castopod/commit/2271c1445b1ded12bc53b5d23b5e59d12b17c71a)),
  closes [#96](https://code.castopod.org/adaures/castopod/issues/96)
- **rss:** use originalPath instead of originalMediaPath in Image library
  ([b4012b7](https://code.castopod.org/adaures/castopod/commit/b4012b7d2ed6b34b69ad767570dd33f0dc7db920))
- save transcript and chapters files to podcasts folder
  ([63f49c7](https://code.castopod.org/adaures/castopod/commit/63f49c719f672b615c5a8893d3868dffcd332e47))
- set cache expiration to next note publish to show note on publication date
  ([0a66de3](https://code.castopod.org/adaures/castopod/commit/0a66de3e6c17d4ac94ee8e13bd00ceaf64b1303e))
- set episode description footer to null when empty value
  ([3a7d97d](https://code.castopod.org/adaures/castopod/commit/3a7d97d660046d80698611311ff3708110d2af82))
- set episode duration translation to hardcoded english
  ([c39efc9](https://code.castopod.org/adaures/castopod/commit/c39efc9489180662edcebd142d4476c0617ea97f)),
  closes [#64](https://code.castopod.org/adaures/castopod/issues/64)
- set episode guid upon episode creation
  ([ad8b153](https://code.castopod.org/adaures/castopod/commit/ad8b153f2a3b1a3b1751bf63785c4950e1516e6b)),
  closes [#48](https://code.castopod.org/adaures/castopod/issues/48)
- set episode numbers during import + remove all custom form_helpers + minor ui
  issues
  ([99a3b8d](https://code.castopod.org/adaures/castopod/commit/99a3b8d33e00482da50dd62bdaa9215a351a56e4))
- set localized slug_field key as string in french language
  ([17fb29b](https://code.castopod.org/adaures/castopod/commit/17fb29b20993b7deee4e252e0e3a4a2459ee0d98))
- set location to null when getting empty string
  ([71b1b5f](https://code.castopod.org/adaures/castopod/commit/71b1b5f775af475b1dc78328330e277f565e41b6))
- **settings:** add .jpg extension to site-icon file input to display all jpeg
  images
  ([f611a16](https://code.castopod.org/adaures/castopod/commit/f611a16cd0c1a389e1c5a287eaec9d2a927a4bb6))
- sort episodic podcasts by season
  ([d7b6794](https://code.castopod.org/adaures/castopod/commit/d7b6794f68f9a01fd606a407c6eb4c12d15dee74))
- **themes:** update themes stylesheet route and remove css extension
  ([e4e7e00](https://code.castopod.org/adaures/castopod/commit/e4e7e0005e931967dd6162588f1c5913dbf4603e))
- **types:** update fake seeders types + fix bugs
  ([76a4bf3](https://code.castopod.org/adaures/castopod/commit/76a4bf344160df679db29e236e7df7822970fb60))
- unpublish episode before deleting it + add validation step before deletion
  ([f75bd76](https://code.castopod.org/adaures/castopod/commit/f75bd76458eeb01a2d37912695e33f77d03b7a69)),
  closes [#112](https://code.castopod.org/adaures/castopod/issues/112)
  [#55](https://code.castopod.org/adaures/castopod/issues/55)
- update .htaccess for shared hosting config
  ([2379826](https://code.castopod.org/adaures/castopod/commit/2379826352e2f4b5060910bf9f29268610102f2e))
- update broken contributor dropdown fields
  ([e5b7515](https://code.castopod.org/adaures/castopod/commit/e5b75150234bd7f19e01def93425d3bda7379dd3))
- update condition in AnalyticsTrait
  ([fbc0967](https://code.castopod.org/adaures/castopod/commit/fbc0967caa81630d514ddb1b93b0834ebb4d913b))
- update condition in home controller to redirect to install page
  ([33f1b91](https://code.castopod.org/adaures/castopod/commit/33f1b91d55dd0652c979d50fc85879dbf88a4a42))
- update conditions when checking for empty max_episodes and season_number
  ([fbad0b5](https://code.castopod.org/adaures/castopod/commit/fbad0b59f68c65eba2fdcd5a8d3b312b622e9a45))
- update iso-369 language table seeder
  ([0c90db4](https://code.castopod.org/adaures/castopod/commit/0c90db44c40de5af5b0b32b54489bda9424d9ef6))
- update MarkdownEditor component + restyle Button and other components
  ([b05d177](https://code.castopod.org/adaures/castopod/commit/b05d177f1b7f44fef043ac5eb41f07133a2cf52d))
- update purgecss content path for php helper files
  ([eb70bb4](https://code.castopod.org/adaures/castopod/commit/eb70bb4f7078ff347aeb8f5dcc7896311d289466)),
  closes [#59](https://code.castopod.org/adaures/castopod/issues/59)
- update translations for settings' tasks to include what they should be used
  for
  ([06b1a8b](https://code.castopod.org/adaures/castopod/commit/06b1a8b29b6ce5d81c5570d250bdac4e0c9ee5ca))
- use slash instead of backslash to call layout
  ([a80adb2](https://code.castopod.org/adaures/castopod/commit/a80adb22958fc0a38374cbce2d950a0042e699eb))
- **ux:** allow for empty message upon episode publication and warn user on
  submit
  ([33d01b8](https://code.castopod.org/adaures/castopod/commit/33d01b8d4fd6ebf24e9f011aa705c456c846956c)),
  closes [#129](https://code.castopod.org/adaures/castopod/issues/129)
- **ux:** redirect user to install page on database error in home page
  ([9017e30](https://code.castopod.org/adaures/castopod/commit/9017e30bf41bed8c2be65091bbc5fb1e63aef87a))
- **video-clips:** check if created video exists before recreating it and
  failing
  ([dff1208](https://code.castopod.org/adaures/castopod/commit/dff12087251b2b89e195604202094b5ddd9a0936))
- **video-clips:** clear video clip cache after process has finished
  ([3ae6232](https://code.castopod.org/adaures/castopod/commit/3ae62325856f6ff331a5d9ed901b9fa097ca7055))
- **video-clips:** create unique temporary files for resources to be deleted
  after generation
  ([7f7c878](https://code.castopod.org/adaures/castopod/commit/7f7c878cb6ecf7b4a967b2af87da82bc6593081e))
- **video-clips:** tweak portrait parameters to have subtitles display without
  overflowing
  ([2385b1a](https://code.castopod.org/adaures/castopod/commit/2385b1a2926d1344569836e18cb30adb4c604664))
- **xml-editor:** escape xml editor's content + restyle form sections to prevent
  overflowing
  ([588590b](https://code.castopod.org/adaures/castopod/commit/588590bd2c0346e2465ff8f1930580d76a3bf068))

### Features

- **activitypub:** add Podcast actor and PodcastEpisode object with comments
  ([9e1e5d2](https://code.castopod.org/adaures/castopod/commit/9e1e5d2e862d6a3345d11ca7f96b955c76bfa013))
- add alternate rss feed link tag to podcast page head
  ([a973c09](https://code.castopod.org/adaures/castopod/commit/a973c097d54a3d0186c4079b9d4d3e81aae38505)),
  closes [#35](https://code.castopod.org/adaures/castopod/issues/35)
- add analytics and unknown useragents
  ([ec92e65](https://code.castopod.org/adaures/castopod/commit/ec92e65aa42e09b1df04600b52a0c679dfc494bb))
- add audio-clipper toolbar + add video-clip-previewer
  ([0255753](https://code.castopod.org/adaures/castopod/commit/02557539e6eb48fc23ee2ee3b0c75aee3310965b))
- add audio-clipper webcomponent (wip)
  ([21d4251](https://code.castopod.org/adaures/castopod/commit/21d4251b9bcd5acb0f8a1761bc4edc34a3dbc228))
- add basic stats on podcast about page
  ([1670558](https://code.castopod.org/adaures/castopod/commit/1670558473dba47219d470ff21d6224db6ab42ba))
- add breadcrumb in admin area
  ([7fb1de2](https://code.castopod.org/adaures/castopod/commit/7fb1de2cf3c97c4cd7afe3bd71bbe66041786ecd)),
  closes [#17](https://code.castopod.org/adaures/castopod/issues/17)
- add cache to ActivityPub sql queries + cache activity and note pages
  ([2d297f4](https://code.castopod.org/adaures/castopod/commit/2d297f45b3d7ef6e8711875a0b9b908e878115fa))
- add CDN url
  ([972bcbf](https://code.castopod.org/adaures/castopod/commit/972bcbf65ee119b8641ca3c4e5c0e8cf9ca8dd4f)),
  closes [#37](https://code.castopod.org/adaures/castopod/issues/37)
- add codemirror to display xml editor for custom rss field
  ([f15f262](https://code.castopod.org/adaures/castopod/commit/f15f26240cd5311fa9d07779f364b6639a501dec))
- add cumulative listening time charts
  ([588b4d2](https://code.castopod.org/adaures/castopod/commit/588b4d28da00bc12d02126e23181690f54d81716))
- add DropdownMenu component + remove global audio player in admin
  ([abb7fba](https://code.castopod.org/adaures/castopod/commit/abb7fbac276d77b7d31a0aeba75d464f3ba3ad46))
- add episode_numbering() component helper to display episode and season numbers
  ([3f4a6bd](https://code.castopod.org/adaures/castopod/commit/3f4a6bd0b9f870f16107a41b102b6bf734868198))
- add french translation
  ([196920d](https://code.castopod.org/adaures/castopod/commit/196920d62f1810b4c35f800d17d7f93627319091))
- add heading component + update ecs rules to fix views
  ([23bdc6f](https://code.castopod.org/adaures/castopod/commit/23bdc6f8e36b7e8dfbe32755a54dea59ad913432))
- add housekeeping task to run after migrations
  ([89dee41](https://code.castopod.org/adaures/castopod/commit/89dee41d583e57251ea9315402a757f03571d7ad))
- add install wizard form to bootstrap database and create the first superadmin
  user
  ([cba871c](https://code.castopod.org/adaures/castopod/commit/cba871c5df9f7120c44d9952456ebbd0d220669e)),
  closes [#2](https://code.castopod.org/adaures/castopod/issues/2)
- add ISO 3166 country codes
  ([97cd94b](https://code.castopod.org/adaures/castopod/commit/97cd94b47494b66faf43fbbe0748872da80020a4))
- add js audio player on podcast, admin and embeddable player pages + fix admon
  episodes ux
  ([0e14eb4](https://code.castopod.org/adaures/castopod/commit/0e14eb4d3f526b0fd256a6144f3fbfc3fe52a357)),
  closes [#131](https://code.castopod.org/adaures/castopod/issues/131)
- add lock podcast according to the Podcastindex podcast-namespace to prevent
  unauthorized import
  ([72b3012](https://code.castopod.org/adaures/castopod/commit/72b301272e0b70ded3e2b237391909e3f152ad0b))
- add map analytics, add episodes analytics, clean analytics page layout,
  translate countries
  ([07eae83](https://code.castopod.org/adaures/castopod/commit/07eae83a00d860e149359fae67d549488403d88b))
- add media entity and link documents, images and audio files to it
  ([6ecf286](https://code.castopod.org/adaures/castopod/commit/6ecf2866cfcde31a0840f15c3340808ce14b44cf))
- add Noto Sans Mono font to use for durations + button to access new video clip
  form in list
  ([7609bb6](https://code.castopod.org/adaures/castopod/commit/7609bb60330539aa91bfdafbb35c2d585624218a))
- add npm for js dependencies + move src/ files to root folder
  ([cbb83a6](https://code.castopod.org/adaures/castopod/commit/cbb83a6f308ac9357e9fb0cca5edae9d3fee5b48))
- add Open Graph and Twitter meta tags
  ([af970b8](https://code.castopod.org/adaures/castopod/commit/af970b8bac949e4c63047e04aca1b7403a4e8deb)),
  closes [#41](https://code.castopod.org/adaures/castopod/issues/41)
- add pages table to store custom instance pages (eg. legal-notice, cookie
  policy, etc.)
  ([9c224a8](https://code.castopod.org/adaures/castopod/commit/9c224a8ac6dd95f3c6c087a300fc8bac48e8090f)),
  closes [#24](https://code.castopod.org/adaures/castopod/issues/24)
- add platform models
  ([a333d29](https://code.castopod.org/adaures/castopod/commit/a333d291966229a909c0851fd8b890ed97c48ceb))
- add platforms form in podcast settings
  ([043f49c](https://code.castopod.org/adaures/castopod/commit/043f49c784bc007ca0fa756ca4ed2d3b08843ad9))
- add platforms tables
  ([ce59344](https://code.castopod.org/adaures/castopod/commit/ce5934419a516c9926dd3fd0ace3c11a95b60722))
- add podcast banner field for each podcast + refactor images configuration
  ([4a8147b](https://code.castopod.org/adaures/castopod/commit/4a8147bfbbd98d9badfc57a0f2a18bdd5812e802))
- add remote_url alternative for transcript and chapters files
  ([3143c9a](https://code.castopod.org/adaures/castopod/commit/3143c9ad36e4cf1364205cf2be39c0c96f80fdd2))
- add replied to post or comment to reply element
  ([d0f9c60](https://code.castopod.org/adaures/castopod/commit/d0f9c6018f1af527099f3e26b5d824710fa11caf))
- add schema.org json-ld objects to podcasts, episodes, posts and comments pages
  ([902f959](https://code.castopod.org/adaures/castopod/commit/902f959b30a10839684f093eb86edebc5d826a0b))
- add task to housekeeping setting for resetting all instance counts
  ([9303e51](https://code.castopod.org/adaures/castopod/commit/9303e51bc50d730a8026f58984e83b840360ee88))
- add unique listeners analytics
  ([3a49258](https://code.castopod.org/adaures/castopod/commit/3a4925816f3268230640525ad7af507aab8eecb9))
- add user permissions and basic groups to handle authorizations
  ([d58e518](https://code.castopod.org/adaures/castopod/commit/d58e51874a4722921b75b0049117015c2380406e)),
  closes [#3](https://code.castopod.org/adaures/castopod/issues/3)
  [#18](https://code.castopod.org/adaures/castopod/issues/18)
- **admin:** make header stick on scroll and show title + action buttons using
  css only
  ([d60498c](https://code.castopod.org/adaures/castopod/commit/d60498c1beb970a14eeb3bbe02d1b1d8116624b0))
- **admin:** update admin layout for better ux + update brand pine colors
  ([d86142e](https://code.castopod.org/adaures/castopod/commit/d86142ebe7cd7582835f180b79fbeaaaba703528))
- allow cross origin requests on episode comments
  ([e12f95a](https://code.castopod.org/adaures/castopod/commit/e12f95aca13c6d54489a9cfd99d4cd2490fe83ab))
- **analytics:** add 'other' group to pie charts in order to display more
  accurate data
  ([73acef9](https://code.castopod.org/adaures/castopod/commit/73acef933ff3485987afc5157de022910876fc12))
- **analytics:** add charts and data export
  ([78625c4](https://code.castopod.org/adaures/castopod/commit/78625c471b4f03a09bd42f72b82217e1f2d01cef))
- **analytics:** add service name from rss user-agent
  ([7202b98](https://code.castopod.org/adaures/castopod/commit/7202b9867bd59aafa8c338a4230fb5e5c55b24c6))
- **analytics:** add weekday and hour bar charts
  ([8ab3132](https://code.castopod.org/adaures/castopod/commit/8ab313296bb4a254ab05e90b17d896039839b784))
- build hashed static files to renew browser cache
  ([37c54d2](https://code.castopod.org/adaures/castopod/commit/37c54d247749bdf8f528babd4a78f24d48051063)),
  closes [#107](https://code.castopod.org/adaures/castopod/issues/107)
- **cache:** add podcast and episode pages to cache + clear them after insert or
  update
  ([da0f047](https://code.castopod.org/adaures/castopod/commit/da0f0472819007e02e5da37399f2377772c618b9))
- **categories:** create model, entity, migrations and seeds
  ([f73b042](https://code.castopod.org/adaures/castopod/commit/f73b042cc091be82abdbbca8992080875d526972))
- **clips:** setup clip entities and model + save video clip to have it
  generated in the background
  ([2f6fdf9](https://code.castopod.org/adaures/castopod/commit/2f6fdf9091d52ca49709fc82621ba1c6dd0e817d))
- **comments:** add comments to episodes + update naming of status to post
  ([bb4752c](https://code.castopod.org/adaures/castopod/commit/bb4752c35e086664f5fd75fdc0d56546a1e356f6))
- **comments:** add like / undo like to comment + add comment page
  ([0c187ef](https://code.castopod.org/adaures/castopod/commit/0c187ef7a9278a60bcc6e5ee4d69d948b51e5c54))
- **components:** add custom view renderer with ComponentRenderer adapted from
  bonfire2
  ([a95de8b](https://code.castopod.org/adaures/castopod/commit/a95de8bab010f6b01c598da72191abe97e473687))
- create optimized & resized images upon upload
  ([02e4441](https://code.castopod.org/adaures/castopod/commit/02e4441f98f27e9534e5b9b63279153d14632ccd)),
  closes [#6](https://code.castopod.org/adaures/castopod/issues/6)
- **custom-rss:** add custom xml tag injection in rss feed for ❬channel❭ and
  ❬item❭
  ([6ecdaad](https://code.castopod.org/adaures/castopod/commit/6ecdaad911d06b7f7a2b7d24710968c7eb9118f6))
- **devcontainer:** add devcontainer settings for dev environment
  ([69e7266](https://code.castopod.org/adaures/castopod/commit/69e72667365247b63430dee88194e8f0d7c28edc))
- display castopod version in admin footer
  ([9f2574e](https://code.castopod.org/adaures/castopod/commit/9f2574e6fbb61dac4e1a4252dff30017685da5f0)),
  closes [#68](https://code.castopod.org/adaures/castopod/issues/68)
- display legal disclaimer and warning on podcast import page
  ([2f07992](https://code.castopod.org/adaures/castopod/commit/2f07992e5508b34b91f194eebfac80c51e80e90a)),
  closes [#34](https://code.castopod.org/adaures/castopod/issues/34)
- edit + delete podcast and episode
  ([ac5f0c7](https://code.castopod.org/adaures/castopod/commit/ac5f0c732806e955c01e05b7867801bc938c6bd5))
- **embeddable-player:** add embeddable player widget
  ([141788f](https://code.castopod.org/adaures/castopod/commit/141788fa089f9dedc8956c64ca515a4a4625f904))
- enhance admin ui with responsive design and ux improvements
  ([2d44b45](https://code.castopod.org/adaures/castopod/commit/2d44b457a02205d2e7da258d7029b8bc5da39533)),
  closes [#31](https://code.castopod.org/adaures/castopod/issues/31)
  [#9](https://code.castopod.org/adaures/castopod/issues/9)
- enhance ui using javascript in admin area
  ([c0e66d5](https://code.castopod.org/adaures/castopod/commit/c0e66d5f7012026e145d106f4d6bd3ba792a1b77))
- **episodes:** add create form and view pages for episode
  ([f3b2c8b](https://code.castopod.org/adaures/castopod/commit/f3b2c8b84f3d93bef734e34dbe8ed729535e45e9)),
  closes [#1](https://code.castopod.org/adaures/castopod/issues/1)
- **episodes:** add migrations, model and entity for episodes table
  ([0444821](https://code.castopod.org/adaures/castopod/commit/044482174ede555ce19a2d8c6f48771cc8e7d27b))
- **episodes:** replace all audio file URL parameters with base64 encoded data
  ([e1f65cd](https://code.castopod.org/adaures/castopod/commit/e1f65cd3b53353a30d4ab6eb5312393cf04a1676))
- **episodes:** schedule episode with future publication_date by using cache
  expiration time
  ([4f1e773](https://code.castopod.org/adaures/castopod/commit/4f1e773c0f9e4c2597f6c1b0a4773dfb34b2f203)),
  closes [#47](https://code.castopod.org/adaures/castopod/issues/47)
- **fediverse:** implement activitypub protocols + update user interface
  ([2f525c0](https://code.castopod.org/adaures/castopod/commit/2f525c0f6e44d320bff16e22c223481923ba683e)),
  closes [#69](https://code.castopod.org/adaures/castopod/issues/69)
  [#65](https://code.castopod.org/adaures/castopod/issues/65)
  [#85](https://code.castopod.org/adaures/castopod/issues/85)
  [#51](https://code.castopod.org/adaures/castopod/issues/51)
  [#91](https://code.castopod.org/adaures/castopod/issues/91)
  [#92](https://code.castopod.org/adaures/castopod/issues/92)
  [#88](https://code.castopod.org/adaures/castopod/issues/88)
- **fonts:** replace Montserrat with Inter for better readability
  ([bfa11d0](https://code.castopod.org/adaures/castopod/commit/bfa11d007d04b8ac714c8cf3b8050a6aaf177a26))
- import podcast from an rss feed url
  ([9a5d5a1](https://code.castopod.org/adaures/castopod/commit/9a5d5a15b4945eb319da9e999c4ca60a0a4f6d2d)),
  closes [#21](https://code.castopod.org/adaures/castopod/issues/21)
- integrate stylized form components and update podcast edit page
  ([6536729](https://code.castopod.org/adaures/castopod/commit/653672954606a23796e8a7bda3c34fd6b92f84e0))
- make displayed publication time as relative time using @github/time-elements
  ([230e139](https://code.castopod.org/adaures/castopod/commit/230e139e43324b9ebef06ca8f6e13b3d9a7bdc70))
- **map:** display geolocated episodes on a map page
  ([4357cc2](https://code.castopod.org/adaures/castopod/commit/4357cc25ccc585ce398035c1c25d566b6a9df775))
- **media:** clean media api + create an entity per media type
  ([fafaa7e](https://code.castopod.org/adaures/castopod/commit/fafaa7e689b17f09a2b056081fa1f4fc53bf716b))
- **media:** save audio, images, transcripts and chapters to media for episode
  and persons
  ([58e2a00](https://code.castopod.org/adaures/castopod/commit/58e2a00a87fa7d5b188e13cc521d94f0cfddba50))
- **meta-tags:** add activitypub alternate links to podcast, episode, comment
  and post pages
  ([bd61752](https://code.castopod.org/adaures/castopod/commit/bd61752be2f574323b05d1d0aee0df55adf9a74e))
- minor corrections to some tables
  ([3bf9420](https://code.castopod.org/adaures/castopod/commit/3bf9420b5956a501b3b24405d243a71a928d6086))
- **monetization:** add Web Monetization support
  ([96a6026](https://code.castopod.org/adaures/castopod/commit/96a6026f1db452085360f5fe248de82a2ec06468))
- **nodeinfo2:** add .well-known route for nodeinfo2 containing metadata about
  the castopod instance
  ([88fddc8](https://code.castopod.org/adaures/castopod/commit/88fddc81d730978f2a4d8a671936b54041e3fe45))
- **partner:** add link and image in episode description
  ([ad07bb9](https://code.castopod.org/adaures/castopod/commit/ad07bb9330dc9493813368e969e1f3a3def44614))
- **person:** add podcastindex.org namespace person tag
  ([8acd011](https://code.castopod.org/adaures/castopod/commit/8acd011f13e99492ef4b44b327685bb006fe5f8f))
- **platforms:** add AntennaPod
  ([53e9cfd](https://code.castopod.org/adaures/castopod/commit/53e9cfd61c794b1539e9d4691d3c4e73c4b7aaa7))
- **platforms:** add Fediverse and some funding platforms, add link on logo
  ([afc3d50](https://code.castopod.org/adaures/castopod/commit/afc3d50289bb4173e0697d109ffe72f6814b93d1))
- **platforms:** add helloasso
  ([16cb993](https://code.castopod.org/adaures/castopod/commit/16cb993ee6e28987a840fc27a9c2c73794c67697))
- **platforms:** add missing newpodcastapps.com's platforms
  ([92dd370](https://code.castopod.org/adaures/castopod/commit/92dd370e2f9a464edd26cddcde96d0e16f91548d))
- **platforms:** add pod.link
  ([3d7a232](https://code.castopod.org/adaures/castopod/commit/3d7a2320ddd116e4a311605421126aff57243219))
- **platforms:** add Podcast Index
  ([ad52b1c](https://code.castopod.org/adaures/castopod/commit/ad52b1cc2b7d0bc844970214d205961a7196b4a9))
- **platforms:** add podfriend
  ([9fdc8d3](https://code.castopod.org/adaures/castopod/commit/9fdc8d32930234c7ffd2be6892be57febcef1086))
- **podcast-form:** update routes and redirect to podcast page
  ([12ce905](https://code.castopod.org/adaures/castopod/commit/12ce905799002dc9c07e6de092342d30ba9fd7d8))
- **podcast:** create a podcast using form
  ([1202ba3](https://code.castopod.org/adaures/castopod/commit/1202ba3545f521097c60a6a2af95e70527cd1d34))
- prefill season and episode numbers + set episode number as mandatory for
  serial podcasts
  ([07d740b](https://code.castopod.org/adaures/castopod/commit/07d740b79f9283e389e723954f680f909ce5de4a)),
  closes [#134](https://code.castopod.org/adaures/castopod/issues/134)
  [#136](https://code.castopod.org/adaures/castopod/issues/136)
- **public-ui:** adapt public podcast and episode pages to wireframes
  ([40a0535](https://code.castopod.org/adaures/castopod/commit/40a0535fc1bc12a24994b651f5e00b35995cbdda)),
  closes [#30](https://code.castopod.org/adaures/castopod/issues/30)
  [#13](https://code.castopod.org/adaures/castopod/issues/13)
- **pwa:** add service-worker + webmanifest for each podcasts to have them
  install on devices
  ([fee2c1c](https://code.castopod.org/adaures/castopod/commit/fee2c1c0d0d03c4ff0a6a207b0a5e0c22bb7b13a))
- redesign public podcast and episode pages + remove any information clutter for
  better ux
  ([9321400](https://code.castopod.org/adaures/castopod/commit/932140077c671f0486a2cd08ceb6126c7ecde87f))
- replace form helper functions with components in admin template
  ([e64548b](https://code.castopod.org/adaures/castopod/commit/e64548b982ba47ff35f2272e2e30dd85eeba950b))
- replace slug field with interactive permalink component
  ([578022b](https://code.castopod.org/adaures/castopod/commit/578022b8c5163ffaf8db5870ed5ec9d5d9536477))
- restyle episode and person cards + add focus style to interactive elements for
  a11y
  ([a505a1d](https://code.castopod.org/adaures/castopod/commit/a505a1de56e8e3056379bd60d0595f432e294728))
- **rss:** add ˂podcast:guid˃ tag for channel
  ([1fab10e](https://code.castopod.org/adaures/castopod/commit/1fab10eb0d63bb7c3edf34ffe691e2aec2c2e43c))
- **rss:** add podcast-namespace tags for platforms + previousUrl tag
  ([dbba8dc](https://code.castopod.org/adaures/castopod/commit/dbba8dc58133967c778514268cbfed8098ed1dbc)),
  closes [#73](https://code.castopod.org/adaures/castopod/issues/73)
  [#75](https://code.castopod.org/adaures/castopod/issues/75)
  [#76](https://code.castopod.org/adaures/castopod/issues/76)
  [#80](https://code.castopod.org/adaures/castopod/issues/80)
- **rss:** add podcast:comments tag to link to episode comments
  ([32e8c7c](https://code.castopod.org/adaures/castopod/commit/32e8c7c16a61ffe08e2f3bfbdeda556811a0358c))
- **rss:** add podcast:location tag
  ([c0a2282](https://code.castopod.org/adaures/castopod/commit/c0a22829bd87d48535a86e60c6cd7280e44683a2))
- **rss:** add soundbites according to the podcastindex specs
  ([6b34617](https://code.castopod.org/adaures/castopod/commit/6b34617d07c70522cb941e96d91d9987493413eb)),
  closes [#83](https://code.castopod.org/adaures/castopod/issues/83)
- **rss:** add transcript and chapters support
  ([e769d83](https://code.castopod.org/adaures/castopod/commit/e769d83a932c169e52a630a17cd4dd8ac5cebaf6)),
  closes [#72](https://code.castopod.org/adaures/castopod/issues/72)
  [#82](https://code.castopod.org/adaures/castopod/issues/82)
- **rss:** generate rss feed from podcast entity
  ([c815ecd](https://code.castopod.org/adaures/castopod/commit/c815ecd6640931fee0895f80908a3ddfac482666))
- **rss:** update monetization tag so that it meets PodcastIndex requirements
  ([4c7ecbe](https://code.castopod.org/adaures/castopod/commit/4c7ecbee83950e5f9f2482cedaab18a1ac9bfc9e))
- **select:** enhance select input with choices.js
  ([910d457](https://code.castopod.org/adaures/castopod/commit/910d457cf843e0fc334b3505a4727d51633395ac))
- set app parameter forceGlobalSecureRequests = true forcing requests to go
  through https
  ([d9dff1b](https://code.castopod.org/adaures/castopod/commit/d9dff1b8bf89c8b526ad6cb89f98a1f160d49117))
- set podcast / episode description in the pages description meta tag
  ([1c4a504](https://code.castopod.org/adaures/castopod/commit/1c4a50442bea2d3449efce9c5ff1c80743152f55)),
  closes [#44](https://code.castopod.org/adaures/castopod/issues/44)
- **settings:** add general config for instance (site name, description and
  icon)
  ([5c56f3e](https://code.castopod.org/adaures/castopod/commit/5c56f3e6f00a61af2ccf50811c155c325f2b10fa))
- **settings:** add theme settings to set an accent color for all public pages
  ([5c529a8](https://code.castopod.org/adaures/castopod/commit/5c529a83aa6d6147d94e5aee996e6b0ab02f0ce4))
- simplify podcast page's layout for better ux
  ([2c0efc6](https://code.castopod.org/adaures/castopod/commit/2c0efc6563604dd067be88cfc9ddd88a01745e64))
- **soundbites:** add soundbite list and creation forms with audio-clipper
  component
  ([de19317](https://code.castopod.org/adaures/castopod/commit/de19317138a2106deb825c1eed7dda036ed7dac3))
- style file inputs using tailwind's file class
  ([8208ab6](https://code.castopod.org/adaures/castopod/commit/8208ab6785aae8c49f78eb9ac8cd53d77ec8e5e5))
- **themes:** add ViewThemes library to set views in root themes folder
  ([7a27676](https://code.castopod.org/adaures/castopod/commit/7a276764e6a1ee3619d9d3488f6163215db75338))
- **themes:** set different default banner per theme
  ([11c916f](https://code.castopod.org/adaures/castopod/commit/11c916fe433eb749ac32230c48e256057564cbb0))
- **themes:** set generic css variables for colors to enable instance themes
  ([a746a78](https://code.castopod.org/adaures/castopod/commit/a746a781b4bfc78209cf8302c6d7bb3cb452e446))
- toggle podcast sidebar on smaller screens
  ([f0205ec](https://code.castopod.org/adaures/castopod/commit/f0205ec274414e881cba40d6776126f05eaee583))
- **transcript:** parse srt subtitles into json file + add max file size info
  below audio file input
  ([0098761](https://code.castopod.org/adaures/castopod/commit/00987610a068c8d6cdd4421ea16585fa037eb61a))
- **ui:** create ViewComponents library to enable building class and view files
  components
  ([94872f2](https://code.castopod.org/adaures/castopod/commit/94872f2338e6025c2f3770be256160838dae9003))
- update analytics so to meet IABv2 requirements
  ([03e23a2](https://code.castopod.org/adaures/castopod/commit/03e23a28bf9b1b73fba55352c36a8cd6cc8ae729)),
  closes [#10](https://code.castopod.org/adaures/castopod/issues/10)
- update pine colors + create charts components
  ([a50abc1](https://code.castopod.org/adaures/castopod/commit/a50abc138d4997b564e3065b37504cda5ce62da6))
- **users:** add myth-auth to handle users crud + add admin gateway only
  accessible by login
  ([c63a077](https://code.castopod.org/adaures/castopod/commit/c63a077618c61b4cde7f25ffc650a4b0e1495f44)),
  closes [#11](https://code.castopod.org/adaures/castopod/issues/11)
- **ux:** remove admin dashboard and redirect directly to podcast list
  ([27c48b8](https://code.castopod.org/adaures/castopod/commit/27c48b8fa930b33e5e15f0c8685e468e857ca9cd))
- **video-clip:** add video-clip page with video preview + logs
  ([42538dd](https://code.castopod.org/adaures/castopod/commit/42538dd7577be0ffe59b4fdfadbd76cc89e5ef30))
- **video-clip:** generate video clips in the bg using a cron job + add video
  clip page + tidy up UI
  ([db0e427](https://code.castopod.org/adaures/castopod/commit/db0e4272bd6d307c562e1f961d2747cb62de0f35))
- **video-clips:** add dimensions for portrait and squared formats
  ([3af404d](https://code.castopod.org/adaures/castopod/commit/3af404da3dd1901c78cc7e1778fc225f6716207d))
- **video-clips:** add new themes + add castopod logo as a watermark
  ([1d1490b](https://code.castopod.org/adaures/castopod/commit/1d1490b06a1f5ecb10b3b98a72efc55d09c10944))
- **video-clips:** add route for scheduled video clips + list video clips with
  status
  ([2065ebb](https://code.castopod.org/adaures/castopod/commit/2065ebbee5e3d0f890ac90b55ca984f1d62a184c))
- **video-clips:** allow episodeNumbering text to stand in the indent of
  episodeTitle paragraph
  ([71a063d](https://code.castopod.org/adaures/castopod/commit/71a063dac311cb21639801fbae6af7c5106c2699))
- **video-clips:** generate a 16:9 video using ffmpeg
  ([35aa7ea](https://code.castopod.org/adaures/castopod/commit/35aa7ea5d9a339b3e6f745137282268d69fe2231))
- **video-clips:** generate subtitles clip using transcript json to have
  subtitles across video
  ([3ce07e4](https://code.castopod.org/adaures/castopod/commit/3ce07e455d171e29be30d8ad45055510eb8d363c))
- **video-clips:** replace hardcoded colors with config's theme colors
  ([e462abf](https://code.castopod.org/adaures/castopod/commit/e462abf6d660e41d2170c52caf45704008de58e9))
- **vite:** add vite config to decouple it from CI_ENVIRONMENT
  ([8721719](https://code.castopod.org/adaures/castopod/commit/8721719cd7cf32e94823541eafaba1e9309355a8))
- write id3v2 tags to episode's audio file
  ([4651d01](https://code.castopod.org/adaures/castopod/commit/4651d01a84ff3ea8433a8ae26cfd750a1ec9e88d))

### Performance Improvements

- **cache:** update CI4 to use cache's deleteMatching method
  ([54b84f9](https://code.castopod.org/adaures/castopod/commit/54b84f96843af13f579fea49102c8c2ef81b0a54))
- **cache:** use deleteMatching method to prevent forgetting cached elements in
  models
  ([76afc0c](https://code.castopod.org/adaures/castopod/commit/76afc0cfa2feb087697bae4bc138e4956873dd62))
- defer javascript + lazy load images for faster page loads
  ([f0685e4](https://code.castopod.org/adaures/castopod/commit/f0685e44799dfb494592ff97841c0ae035381db8))
- **docker:** add redis caching service for development
  ([05ace8c](https://code.castopod.org/adaures/castopod/commit/05ace8cff2ef02d19abd40097ac5546dca6a54ca))

### Reverts

- set deprecated config options back in App config
  ([433745f](https://code.castopod.org/adaures/castopod/commit/433745f194c73407999b207090478563283876a5))
- **soundbites:** remove soundbite table from episode's public page
  ([5dc0f19](https://code.castopod.org/adaures/castopod/commit/5dc0f19656de0d764f627d6ae78a9e306c901835))
- use basic input file for episodes audio files instead of button for better UX
  ([d5f22fb](https://code.castopod.org/adaures/castopod/commit/d5f22fbb38c43d9b37df401eff655958a57cb40a))

### BREAKING CHANGES

- **analytics:** analytics_podcasts_by_player table and analytics_podcasts
  procedure were updated

# [1.0.0-alpha.80](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.79...v1.0.0-alpha.80) (2021-12-29)

### Bug Fixes

- add application/octet-stream mimetype to mp3 and m4a extensions to prevent
  ext_in error
  ([339bef8](https://code.castopod.org/adaures/castopod/commit/339bef878e54983d86e91e6ff7a931a843d321b3)),
  closes [#145](https://code.castopod.org/adaures/castopod/issues/145)

# [1.0.0-alpha.79](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.78...v1.0.0-alpha.79) (2021-12-20)

### Bug Fixes

- **import:** set episode and season numbers to null when not present in item
  tag
  ([3211398](https://code.castopod.org/adaures/castopod/commit/3211398c78b1b28b76a46427ee07874bbf84a85d))

# [1.0.0-alpha.78](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.77...v1.0.0-alpha.78) (2021-12-15)

### Bug Fixes

- **import:** add extension when downloading file without + truncate slug if too
  long
  ([c5f18bb](https://code.castopod.org/adaures/castopod/commit/c5f18bb6dc08a758ff735454bbe9cfa45a68c09b))

# [1.0.0-alpha.77](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.76...v1.0.0-alpha.77) (2021-11-23)

### Bug Fixes

- **cors:** add preflight option routes for episode, podcast and status objects
  ([a281abf](https://code.castopod.org/adaures/castopod/commit/a281abfda475388a07943c169dab460cc2d4f944))
- **podcast-import:** move guid attribute declaration for Episode entity to
  include slug data
  ([5d02ae3](https://code.castopod.org/adaures/castopod/commit/5d02ae39908a9d743627135b372bf981134c4328))

# [1.0.0-alpha.76](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.75...v1.0.0-alpha.76) (2021-10-26)

### Bug Fixes

- replace hardcoded style links with vite service + set default value for remote
  transcript url
  ([3f2e056](https://code.castopod.org/adaures/castopod/commit/3f2e05608e43d47bbb518a9acfaf56ec3eefafb4)),
  closes [#149](https://code.castopod.org/adaures/castopod/issues/149)
  [#150](https://code.castopod.org/adaures/castopod/issues/150)

# [1.0.0-alpha.75](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.74...v1.0.0-alpha.75) (2021-10-05)

### Bug Fixes

- **rss:** cast number type values to string in rss_helper
  ([7180ae9](https://code.castopod.org/adaures/castopod/commit/7180ae9ec700930b69c04ed91f8eceea16ad77ce)),
  closes [#148](https://code.castopod.org/adaures/castopod/issues/148)

# [1.0.0-alpha.74](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.73...v1.0.0-alpha.74) (2021-09-28)

### Features

- **platforms:** add missing newpodcastapps.com's platforms
  ([92dd370](https://code.castopod.org/adaures/castopod/commit/92dd370e2f9a464edd26cddcde96d0e16f91548d))

# [1.0.0-alpha.73](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.72...v1.0.0-alpha.73) (2021-09-22)

### Bug Fixes

- **map:** update episode markers query to discard unpublished episodes
  ([b3caac4](https://code.castopod.org/adaures/castopod/commit/b3caac45b12a23e4289d00133d2ad7915d084c44))

# [1.0.0-alpha.72](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.71...v1.0.0-alpha.72) (2021-09-20)

### Bug Fixes

- rename field status to task_status to get scheduled activities
  ([4ff82a5](https://code.castopod.org/adaures/castopod/commit/4ff82a5f0a38dbbc9e272fca7df70ea5a190e334))

# [1.0.0-alpha.71](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.70...v1.0.0-alpha.71) (2021-09-17)

### Features

- **map:** display geolocated episodes on a map page
  ([4357cc2](https://code.castopod.org/adaures/castopod/commit/4357cc25ccc585ce398035c1c25d566b6a9df775))

# [1.0.0-alpha.70](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.69...v1.0.0-alpha.70) (2021-08-31)

### Bug Fixes

- **partner:** set correct image URL
  ([61554be](https://code.castopod.org/adaures/castopod/commit/61554be12a64d59ab99fab810b1b05632b408f3a))

# [1.0.0-alpha.69](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.68...v1.0.0-alpha.69) (2021-08-23)

### Bug Fixes

- **import:** cast description's SimpleXMLElement to string
  ([02d17be](https://code.castopod.org/adaures/castopod/commit/02d17be4ffe229fc6657207d31eba0543b5f1a4c))

# [1.0.0-alpha.68](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.67...v1.0.0-alpha.68) (2021-08-19)

### Bug Fixes

- **analytics:** redirect to mp3 file even when referer was not set
  ([9fc388d](https://code.castopod.org/adaures/castopod/commit/9fc388d154f29c335dedcd624abe8c1751762c07))

# [1.0.0-alpha.67](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.66...v1.0.0-alpha.67) (2021-07-24)

### Features

- allow cross origin requests on episode comments
  ([e12f95a](https://code.castopod.org/adaures/castopod/commit/e12f95aca13c6d54489a9cfd99d4cd2490fe83ab))

# [1.0.0-alpha.66](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.65...v1.0.0-alpha.66) (2021-07-24)

### Features

- **rss:** add podcast:comments tag to link to episode comments
  ([32e8c7c](https://code.castopod.org/adaures/castopod/commit/32e8c7c16a61ffe08e2f3bfbdeda556811a0358c))

# [1.0.0-alpha.65](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.64...v1.0.0-alpha.65) (2021-07-22)

### Bug Fixes

- update conditions when checking for empty max_episodes and season_number
  ([fbad0b5](https://code.castopod.org/adaures/castopod/commit/fbad0b59f68c65eba2fdcd5a8d3b312b622e9a45))

# [1.0.0-alpha.64](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.63...v1.0.0-alpha.64) (2021-07-12)

### Features

- **activitypub:** add Podcast actor and PodcastEpisode object with comments
  ([9e1e5d2](https://code.castopod.org/adaures/castopod/commit/9e1e5d2e862d6a3345d11ca7f96b955c76bfa013))

# [1.0.0-alpha.63](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.62...v1.0.0-alpha.63) (2021-07-12)

### Features

- build hashed static files to renew browser cache
  ([37c54d2](https://code.castopod.org/adaures/castopod/commit/37c54d247749bdf8f528babd4a78f24d48051063)),
  closes [#107](https://code.castopod.org/adaures/castopod/issues/107)

# [1.0.0-alpha.62](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.61...v1.0.0-alpha.62) (2021-07-02)

### Bug Fixes

- **episode:** replace guid's empty string value to null
  ([441052a](https://code.castopod.org/adaures/castopod/commit/441052af8d99e6e317edefd1e58ad71799357088))

# [1.0.0-alpha.61](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.60...v1.0.0-alpha.61) (2021-06-23)

### Bug Fixes

- **release:** add missing version number to castopod-host package
  ([8f3e9d9](https://code.castopod.org/adaures/castopod/commit/8f3e9d90c14545d3f84d4469b26a53db4554b4dc))
- **ux:** allow for empty message upon episode publication and warn user on
  submit
  ([33d01b8](https://code.castopod.org/adaures/castopod/commit/33d01b8d4fd6ebf24e9f011aa705c456c846956c)),
  closes [#129](https://code.castopod.org/adaures/castopod/issues/129)

# [1.0.0-alpha.60](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.59...v1.0.0-alpha.60) (2021-06-21)

### Features

- **rss:** add ˂podcast:guid˃ tag for channel
  ([1fab10e](https://code.castopod.org/adaures/castopod/commit/1fab10eb0d63bb7c3edf34ffe691e2aec2c2e43c))

# [1.0.0-alpha.59](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.58...v1.0.0-alpha.59) (2021-06-15)

### Bug Fixes

- check that additional files are valid when creating episode
  ([eac5bc8](https://code.castopod.org/adaures/castopod/commit/eac5bc876de125e1fe08d1b89f767a04fc0fbfb6))

# [1.0.0-alpha.58](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.57...v1.0.0-alpha.58) (2021-06-11)

### Bug Fixes

- cast actor_id to pass as int to set_interact_as_actor() function
  ([56a8e5d](https://code.castopod.org/adaures/castopod/commit/56a8e5d7dd615322aeb007e730801c65d0b02e5c))
- **analytics:** set duration field to precise decimal as episode's audio file
  duration
  ([d772685](https://code.castopod.org/adaures/castopod/commit/d77268540569b2be9d91d5e09aefb3ff5ac2b071))
- **analytics:** update migrations to set decimal precision for latitude and
  longitude
  ([714d6b5](https://code.castopod.org/adaures/castopod/commit/714d6b5d4950e52cf1c3170bb59954f98ffd48bd))
- check for database connection and podcasts table existence before redirecting
  to install
  ([eb74e81](https://code.castopod.org/adaures/castopod/commit/eb74e81c3d93581e310b391cd029e62a0d690a8a))
- save transcript and chapters files to podcasts folder
  ([63f49c7](https://code.castopod.org/adaures/castopod/commit/63f49c719f672b615c5a8893d3868dffcd332e47))
- set cache expiration to next note publish to show note on publication date
  ([0a66de3](https://code.castopod.org/adaures/castopod/commit/0a66de3e6c17d4ac94ee8e13bd00ceaf64b1303e))
- set episode description footer to null when empty value
  ([3a7d97d](https://code.castopod.org/adaures/castopod/commit/3a7d97d660046d80698611311ff3708110d2af82))
- set location to null when getting empty string
  ([71b1b5f](https://code.castopod.org/adaures/castopod/commit/71b1b5f775af475b1dc78328330e277f565e41b6))
- update condition in home controller to redirect to install page
  ([33f1b91](https://code.castopod.org/adaures/castopod/commit/33f1b91d55dd0652c979d50fc85879dbf88a4a42))
- **activity-pub:** cache issues when navigating to activity stream urls
  ([7bcbfb3](https://code.castopod.org/adaures/castopod/commit/7bcbfb32f7cca08d111be46c7f1640e372d4a4b0))
- **activity-pub:** get database records using new model instances
  ([92536dd](https://code.castopod.org/adaures/castopod/commit/92536ddb3812214a9c5682b92e547e5c1998a5d7))
- **category:** remove uncategorized option to enforce users in choosing a
  category
  ([8c64f25](https://code.castopod.org/adaures/castopod/commit/8c64f25a0e72fec03d25544797d32623b2276fce))
- **install:** redirect manually to install wizard on first visit
  ([2ceaaca](https://code.castopod.org/adaures/castopod/commit/2ceaaca44f1b82fc64d961e2fb4f4aaeade7e736))
- **types:** update fake seeders types + fix bugs
  ([76a4bf3](https://code.castopod.org/adaures/castopod/commit/76a4bf344160df679db29e236e7df7822970fb60))
- update broken contributor dropdown fields
  ([e5b7515](https://code.castopod.org/adaures/castopod/commit/e5b75150234bd7f19e01def93425d3bda7379dd3))
- **ux:** redirect user to install page on database error in home page
  ([9017e30](https://code.castopod.org/adaures/castopod/commit/9017e30bf41bed8c2be65091bbc5fb1e63aef87a))
- update condition in AnalyticsTrait
  ([fbc0967](https://code.castopod.org/adaures/castopod/commit/fbc0967caa81630d514ddb1b93b0834ebb4d913b))

### Performance Improvements

- **cache:** use deleteMatching method to prevent forgetting cached elements in
  models
  ([76afc0c](https://code.castopod.org/adaures/castopod/commit/76afc0cfa2feb087697bae4bc138e4956873dd62))

### Reverts

- set deprecated config options back in App config
  ([433745f](https://code.castopod.org/adaures/castopod/commit/433745f194c73407999b207090478563283876a5))

# [1.0.0-alpha.57](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.56...v1.0.0-alpha.57) (2021-05-12)

### Bug Fixes

- **follow:** add missing helpers to Actor controller
  ([ee53a73](https://code.castopod.org/adaures/castopod/commit/ee53a732dc12ebbf5706e14969749a12cfd9d559))

# [1.0.0-alpha.56](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.55...v1.0.0-alpha.56) (2021-05-12)

### Bug Fixes

- **rss:** use originalPath instead of originalMediaPath in Image library
  ([b4012b7](https://code.castopod.org/adaures/castopod/commit/b4012b7d2ed6b34b69ad767570dd33f0dc7db920))

# [1.0.0-alpha.55](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.54...v1.0.0-alpha.55) (2021-05-03)

### Features

- add remote_url alternative for transcript and chapters files
  ([3143c9a](https://code.castopod.org/adaures/castopod/commit/3143c9ad36e4cf1364205cf2be39c0c96f80fdd2))

# [1.0.0-alpha.54](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.53...v1.0.0-alpha.54) (2021-05-03)

### Features

- set app parameter forceGlobalSecureRequests = true forcing requests to go
  through https
  ([d9dff1b](https://code.castopod.org/adaures/castopod/commit/d9dff1b8bf89c8b526ad6cb89f98a1f160d49117))
- **ux:** remove admin dashboard and redirect directly to podcast list
  ([27c48b8](https://code.castopod.org/adaures/castopod/commit/27c48b8fa930b33e5e15f0c8685e468e857ca9cd))
- add cache to ActivityPub sql queries + cache activity and note pages
  ([2d297f4](https://code.castopod.org/adaures/castopod/commit/2d297f45b3d7ef6e8711875a0b9b908e878115fa))

### Performance Improvements

- **cache:** update CI4 to use cache's deleteMatching method
  ([54b84f9](https://code.castopod.org/adaures/castopod/commit/54b84f96843af13f579fea49102c8c2ef81b0a54))
- **docker:** add redis caching service for development
  ([05ace8c](https://code.castopod.org/adaures/castopod/commit/05ace8cff2ef02d19abd40097ac5546dca6a54ca))

# [1.0.0-alpha.53](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.52...v1.0.0-alpha.53) (2021-04-16)

### Bug Fixes

- check that note has a preview_card_id before displaying it
  ([acb8b3a](https://code.castopod.org/adaures/castopod/commit/acb8b3a40172ccb184ffe544760601d756692e6c)),
  closes [#114](https://code.castopod.org/adaures/castopod/issues/114)

# [1.0.0-alpha.52](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.51...v1.0.0-alpha.52) (2021-04-16)

### Bug Fixes

- **avatar:** use default avatar when no avatar url has been set
  ([9d23c7e](https://code.castopod.org/adaures/castopod/commit/9d23c7e7e142c6cf1a1418e37e41d711064593c4)),
  closes [#111](https://code.castopod.org/adaures/castopod/issues/111)

# [1.0.0-alpha.51](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.50...v1.0.0-alpha.51) (2021-04-15)

### Bug Fixes

- **interact-as:** set actor_id instead of podcast id upon login event
  ([5dfade7](https://code.castopod.org/adaures/castopod/commit/5dfade7cf37f339c56d2e577c679b88a1b1d9336)),
  closes [#104](https://code.castopod.org/adaures/castopod/issues/104)

# [1.0.0-alpha.50](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.49...v1.0.0-alpha.50) (2021-04-14)

### Bug Fixes

- **persons:** prevent overflow of persons list by adding horizontal scroll
  ([9e8995d](https://code.castopod.org/adaures/castopod/commit/9e8995dc6e039032cc65f87895cf770f99e8b244))

# [1.0.0-alpha.49](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.48...v1.0.0-alpha.49) (2021-04-12)

### Bug Fixes

- **multiselect:** add missing class names in choices options for purge to work
  properly
  ([719538d](https://code.castopod.org/adaures/castopod/commit/719538d0ccb28af3c3c5e1a4b6468d4b772fe819))

# [1.0.0-alpha.48](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.47...v1.0.0-alpha.48) (2021-04-10)

### Bug Fixes

- **import-with-escaped-characters:** remove \CodeIgniter\HTTP\URI in
  download_file, closes
  [#103](https://code.castopod.org/adaures/castopod/issues/103)
  ([35b5be0](https://code.castopod.org/adaures/castopod/commit/35b5be095ff54d27acec1610a846ec0cdbdf1d65))

# [1.0.0-alpha.47](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.46...v1.0.0-alpha.47) (2021-04-10)

### Bug Fixes

- **episodeCount:** add missing brackets to French language file
  ([c1b4112](https://code.castopod.org/adaures/castopod/commit/c1b411265ad9b06e95a8b097ecf73445b88dcb45))

# [1.0.0-alpha.46](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.45...v1.0.0-alpha.46) (2021-04-09)

### Bug Fixes

- **episodes-page:** handle defaultQuery being null when no podcast episodes
  ([15183b7](https://code.castopod.org/adaures/castopod/commit/15183b7eab57dac007bcdfa8c3651239de1ae05a)),
  closes [#100](https://code.castopod.org/adaures/castopod/issues/100)

# [1.0.0-alpha.45](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.44...v1.0.0-alpha.45) (2021-04-08)

### Bug Fixes

- add head request to analytics_hit route
  ([f0a2f0b](https://code.castopod.org/adaures/castopod/commit/f0a2f0bea491ca91976b351bb79837e95c9d094b))

# [1.0.0-alpha.44](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.43...v1.0.0-alpha.44) (2021-04-08)

### Bug Fixes

- **rss:** set ❬itunes:author❭ tag to owner_name if publisher not specified
  ([2271c14](https://code.castopod.org/adaures/castopod/commit/2271c1445b1ded12bc53b5d23b5e59d12b17c71a)),
  closes [#96](https://code.castopod.org/adaures/castopod/issues/96)

# [1.0.0-alpha.43](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.42...v1.0.0-alpha.43) (2021-04-08)

### Bug Fixes

- **episode-form:** show warning to set `memory_limit`, `upload_max_filesize` &
  `post_max_size`
  ([3b3c218](https://code.castopod.org/adaures/castopod/commit/3b3c218b9c868e9f12c54d7670e69d84c9ee79c0)),
  closes [#5](https://code.castopod.org/adaures/castopod/issues/5)
  [#86](https://code.castopod.org/adaures/castopod/issues/86)

# [1.0.0-alpha.42](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.41...v1.0.0-alpha.42) (2021-04-02)

### Features

- **fediverse:** implement activitypub protocols + update user interface
  ([2f525c0](https://code.castopod.org/adaures/castopod/commit/2f525c0f6e44d320bff16e22c223481923ba683e)),
  closes [#69](https://code.castopod.org/adaures/castopod/issues/69)
  [#65](https://code.castopod.org/adaures/castopod/issues/65)
  [#85](https://code.castopod.org/adaures/castopod/issues/85)
  [#51](https://code.castopod.org/adaures/castopod/issues/51)
  [#91](https://code.castopod.org/adaures/castopod/issues/91)
  [#92](https://code.castopod.org/adaures/castopod/issues/92)
  [#88](https://code.castopod.org/adaures/castopod/issues/88)

# [1.0.0-alpha.41](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.40...v1.0.0-alpha.41) (2021-03-30)

### Features

- **partner:** add link and image in episode description
  ([ad07bb9](https://code.castopod.org/adaures/castopod/commit/ad07bb9330dc9493813368e969e1f3a3def44614))

# [1.0.0-alpha.40](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.39...v1.0.0-alpha.40) (2021-03-19)

### Features

- **custom-rss:** add custom xml tag injection in rss feed for ❬channel❭ and
  ❬item❭
  ([6ecdaad](https://code.castopod.org/adaures/castopod/commit/6ecdaad911d06b7f7a2b7d24710968c7eb9118f6))

# [1.0.0-alpha.39](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.38...v1.0.0-alpha.39) (2021-03-01)

### Bug Fixes

- **embeddable-player:** enable any ancestor when X-Frame-Options is set on
  server
  ([44a4962](https://code.castopod.org/adaures/castopod/commit/44a4962e0b7e3ed87e9914b4e7792a0d52330ff8))

# [1.0.0-alpha.38](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.37...v1.0.0-alpha.38) (2021-02-27)

### Features

- **embeddable-player:** add embeddable player widget
  ([141788f](https://code.castopod.org/adaures/castopod/commit/141788fa089f9dedc8956c64ca515a4a4625f904))

# [1.0.0-alpha.37](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.36...v1.0.0-alpha.37) (2021-02-17)

### Bug Fixes

- **import:** remove query string from files url
  ([109c4aa](https://code.castopod.org/adaures/castopod/commit/109c4aa1afb72dd8b99c0302d74a7fef5a38638e))

# [1.0.0-alpha.36](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.35...v1.0.0-alpha.36) (2021-02-16)

### Features

- **platforms:** add pod.link
  ([3d7a232](https://code.castopod.org/adaures/castopod/commit/3d7a2320ddd116e4a311605421126aff57243219))

# [1.0.0-alpha.35](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.34...v1.0.0-alpha.35) (2021-02-12)

### Bug Fixes

- **admin:** save block and lock switches
  ([b66c0af](https://code.castopod.org/adaures/castopod/commit/b66c0afc8fab2e338402a9a4f8105e5f5459e208))

# [1.0.0-alpha.34](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.33...v1.0.0-alpha.34) (2021-02-11)

### Bug Fixes

- **rss-import:** add Castopod user-agent, handle redirects for downloaded
  files, add Content namespace
  ([214243b](https://code.castopod.org/adaures/castopod/commit/214243b3fec4937e45ef1ceaba1149004cdf3b44))

# [1.0.0-alpha.33](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.32...v1.0.0-alpha.33) (2021-02-10)

### Features

- **platforms:** add helloasso
  ([16cb993](https://code.castopod.org/adaures/castopod/commit/16cb993ee6e28987a840fc27a9c2c73794c67697))

# [1.0.0-alpha.32](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.31...v1.0.0-alpha.32) (2021-02-10)

### Features

- **person:** add podcastindex.org namespace person tag
  ([8acd011](https://code.castopod.org/adaures/castopod/commit/8acd011f13e99492ef4b44b327685bb006fe5f8f))

# [1.0.0-alpha.31](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.30...v1.0.0-alpha.31) (2020-12-23)

### Features

- **rss:** add podcast:location tag
  ([c0a2282](https://code.castopod.org/adaures/castopod/commit/c0a22829bd87d48535a86e60c6cd7280e44683a2))

# [1.0.0-alpha.30](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.29...v1.0.0-alpha.30) (2020-12-21)

### Features

- **rss:** update monetization tag so that it meets PodcastIndex requirements
  ([4c7ecbe](https://code.castopod.org/adaures/castopod/commit/4c7ecbee83950e5f9f2482cedaab18a1ac9bfc9e))

# [1.0.0-alpha.29](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.28...v1.0.0-alpha.29) (2020-12-10)

### Bug Fixes

- **episodes:** add publication status + set publication date to null when none
  has been set
  ([d882981](https://code.castopod.org/adaures/castopod/commit/d882981b3a86c81921ce6b07d4cf61fc13983689)),
  closes [#70](https://code.castopod.org/adaures/castopod/issues/70)

### Reverts

- **soundbites:** remove soundbite table from episode's public page
  ([5dc0f19](https://code.castopod.org/adaures/castopod/commit/5dc0f19656de0d764f627d6ae78a9e306c901835))

# [1.0.0-alpha.28](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.27...v1.0.0-alpha.28) (2020-12-07)

### Features

- **rss:** add soundbites according to the podcastindex specs
  ([6b34617](https://code.castopod.org/adaures/castopod/commit/6b34617d07c70522cb941e96d91d9987493413eb)),
  closes [#83](https://code.castopod.org/adaures/castopod/issues/83)

# [1.0.0-alpha.27](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.26...v1.0.0-alpha.27) (2020-12-07)

### Features

- **platforms:** add AntennaPod
  ([53e9cfd](https://code.castopod.org/adaures/castopod/commit/53e9cfd61c794b1539e9d4691d3c4e73c4b7aaa7))

# [1.0.0-alpha.26](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.25...v1.0.0-alpha.26) (2020-11-30)

### Bug Fixes

- **analytics:** update service management so that it works with new OPAWG slug
  values
  ([7fe9d42](https://code.castopod.org/adaures/castopod/commit/7fe9d42500ade2c6fa3ff4365b4affc475af0e51))

# [1.0.0-alpha.25](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.24...v1.0.0-alpha.25) (2020-11-30)

### Features

- **platforms:** add podfriend
  ([9fdc8d3](https://code.castopod.org/adaures/castopod/commit/9fdc8d32930234c7ffd2be6892be57febcef1086))

# [1.0.0-alpha.24](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.23...v1.0.0-alpha.24) (2020-11-26)

### Features

- **monetization:** add Web Monetization support
  ([96a6026](https://code.castopod.org/adaures/castopod/commit/96a6026f1db452085360f5fe248de82a2ec06468))

# [1.0.0-alpha.23](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.22...v1.0.0-alpha.23) (2020-11-24)

### Bug Fixes

- define podcastNamespaceLink value
  ([0d744d2](https://code.castopod.org/adaures/castopod/commit/0d744d212df0d070ceea185068eaf2746e1ccd48))

# [1.0.0-alpha.22](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.21...v1.0.0-alpha.22) (2020-11-24)

### Features

- **rss:** add transcript and chapters support
  ([e769d83](https://code.castopod.org/adaures/castopod/commit/e769d83a932c169e52a630a17cd4dd8ac5cebaf6)),
  closes [#72](https://code.castopod.org/adaures/castopod/issues/72)
  [#82](https://code.castopod.org/adaures/castopod/issues/82)

# [1.0.0-alpha.21](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.20...v1.0.0-alpha.21) (2020-11-24)

### Features

- **platforms:** add Fediverse and some funding platforms, add link on logo
  ([afc3d50](https://code.castopod.org/adaures/castopod/commit/afc3d50289bb4173e0697d109ffe72f6814b93d1))

# [1.0.0-alpha.20](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.19...v1.0.0-alpha.20) (2020-11-24)

### Bug Fixes

- **import:** use <image><url> tag when no <itunes:image> is present
  ([20e607a](https://code.castopod.org/adaures/castopod/commit/20e607afb755bc75056041738fa7cbf6723d754c))

### Features

- **rss:** add podcast-namespace tags for platforms + previousUrl tag
  ([dbba8dc](https://code.castopod.org/adaures/castopod/commit/dbba8dc58133967c778514268cbfed8098ed1dbc)),
  closes [#73](https://code.castopod.org/adaures/castopod/issues/73)
  [#75](https://code.castopod.org/adaures/castopod/issues/75)
  [#76](https://code.castopod.org/adaures/castopod/issues/76)
  [#80](https://code.castopod.org/adaures/castopod/issues/80)

# [1.0.0-alpha.19](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.18...v1.0.0-alpha.19) (2020-11-13)

### Bug Fixes

- handle HEAD requests on podcast_feed route
  ([74b2640](https://code.castopod.org/adaures/castopod/commit/74b2640f2a25c4cd6fd8835fc492c2a6893d4950)),
  closes [#79](https://code.castopod.org/adaures/castopod/issues/79)

# [1.0.0-alpha.18](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.17...v1.0.0-alpha.18) (2020-11-09)

### Features

- **platforms:** add Podcast Index
  ([ad52b1c](https://code.castopod.org/adaures/castopod/commit/ad52b1cc2b7d0bc844970214d205961a7196b4a9))

# [1.0.0-alpha.17](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.16...v1.0.0-alpha.17) (2020-11-05)

### Bug Fixes

- **open-graph:** replace non existant episode description to podcast
  description in podcast page
  ([b02584e](https://code.castopod.org/adaures/castopod/commit/b02584ee609af1ad1b5680cc28208d113eb0410b))

# [1.0.0-alpha.16](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.15...v1.0.0-alpha.16) (2020-11-04)

### Features

- add Open Graph and Twitter meta tags
  ([af970b8](https://code.castopod.org/adaures/castopod/commit/af970b8bac949e4c63047e04aca1b7403a4e8deb)),
  closes [#41](https://code.castopod.org/adaures/castopod/issues/41)

# [1.0.0-alpha.15](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.14...v1.0.0-alpha.15) (2020-11-03)

### Features

- **analytics:** add 'other' group to pie charts in order to display more
  accurate data
  ([73acef9](https://code.castopod.org/adaures/castopod/commit/73acef933ff3485987afc5157de022910876fc12))

# [1.0.0-alpha.14](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.13...v1.0.0-alpha.14) (2020-11-02)

### Features

- **analytics:** add weekday and hour bar charts
  ([8ab3132](https://code.castopod.org/adaures/castopod/commit/8ab313296bb4a254ab05e90b17d896039839b784))

# [1.0.0-alpha.13](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.12...v1.0.0-alpha.13) (2020-10-29)

### Bug Fixes

- **episodes-table:** set descriptions to be not null
  ([6774ec1](https://code.castopod.org/adaures/castopod/commit/6774ec10fa78527be6b7548ca1dc34ad0ada090c))

### Features

- add episode_numbering() component helper to display episode and season numbers
  ([3f4a6bd](https://code.castopod.org/adaures/castopod/commit/3f4a6bd0b9f870f16107a41b102b6bf734868198))
- **episodes:** replace all audio file URL parameters with base64 encoded data
  ([e1f65cd](https://code.castopod.org/adaures/castopod/commit/e1f65cd3b53353a30d4ab6eb5312393cf04a1676))

# [1.0.0-alpha.12](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.11...v1.0.0-alpha.12) (2020-10-26)

### Bug Fixes

- replace getWebEnclosureUrl with getEnclosureWebUrl
  ([8122cea](https://code.castopod.org/adaures/castopod/commit/8122ceaf8a70050f14b3078f28b024e7d7cdb9ac))

# [1.0.0-alpha.11](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.10...v1.0.0-alpha.11) (2020-10-26)

### Features

- add CDN url
  ([972bcbf](https://code.castopod.org/adaures/castopod/commit/972bcbf65ee119b8641ca3c4e5c0e8cf9ca8dd4f)),
  closes [#37](https://code.castopod.org/adaures/castopod/issues/37)

# [1.0.0-alpha.10](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.9...v1.0.0-alpha.10) (2020-10-26)

### Bug Fixes

- **install:** redirect to host_url install route on instanceConfig validation
  error
  ([99250b1](https://code.castopod.org/adaures/castopod/commit/99250b1868657c249a447399c7ebc69e00d43d1a))

# [1.0.0-alpha.9](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.8...v1.0.0-alpha.9) (2020-10-26)

### Features

- display castopod version in admin footer
  ([9f2574e](https://code.castopod.org/adaures/castopod/commit/9f2574e6fbb61dac4e1a4252dff30017685da5f0)),
  closes [#68](https://code.castopod.org/adaures/castopod/issues/68)

# [1.0.0-alpha.8](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.7...v1.0.0-alpha.8) (2020-10-22)

### Features

- **episodes:** schedule episode with future publication_date by using cache
  expiration time
  ([4f1e773](https://code.castopod.org/adaures/castopod/commit/4f1e773c0f9e4c2597f6c1b0a4773dfb34b2f203)),
  closes [#47](https://code.castopod.org/adaures/castopod/issues/47)

# [1.0.0-alpha.7](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.6...v1.0.0-alpha.7) (2020-10-21)

### Features

- **analytics:** add service name from rss user-agent
  ([7202b98](https://code.castopod.org/adaures/castopod/commit/7202b9867bd59aafa8c338a4230fb5e5c55b24c6))

### BREAKING CHANGES

- **analytics:** analytics_podcasts_by_player table and analytics_podcasts
  procedure were updated

# [1.0.0-alpha.6](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.5...v1.0.0-alpha.6) (2020-10-20)

### Bug Fixes

- **cache:** add locale for podcast and episode pages + clear some persisting
  cache in models
  ([9cec8a8](https://code.castopod.org/adaures/castopod/commit/9cec8a81ccbb7239402fe6633dbc31979272302a)),
  closes [#42](https://code.castopod.org/adaures/castopod/issues/42)
  [#61](https://code.castopod.org/adaures/castopod/issues/61)

# [1.0.0-alpha.5](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.4...v1.0.0-alpha.5) (2020-10-20)

### Features

- add lock podcast according to the Podcastindex podcast-namespace to prevent
  unauthorized import
  ([72b3012](https://code.castopod.org/adaures/castopod/commit/72b301272e0b70ded3e2b237391909e3f152ad0b))

# [1.0.0-alpha.4](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.3...v1.0.0-alpha.4) (2020-10-20)

### Features

- **analytics:** add charts and data export
  ([78625c4](https://code.castopod.org/adaures/castopod/commit/78625c471b4f03a09bd42f72b82217e1f2d01cef))

# [1.0.0-alpha.3](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.2...v1.0.0-alpha.3) (2020-10-19)

### Bug Fixes

- **analytics:** remove charts empty values + remove useless language cache
  ([1678794](https://code.castopod.org/adaures/castopod/commit/16787941539ba4014281a366789ea896a9cd2afc))

# [1.0.0-alpha.2](https://code.castopod.org/adaures/castopod/compare/v1.0.0-alpha.1...v1.0.0-alpha.2) (2020-10-19)

### Features

- add cumulative listening time charts
  ([588b4d2](https://code.castopod.org/adaures/castopod/commit/588b4d28da00bc12d02126e23181690f54d81716))

# 1.0.0-alpha.1 (2020-10-16)

### Bug Fixes

- add public/media folder to castopod bundle
  ([8053d35](https://code.castopod.org/adaures/castopod/commit/8053d3521b481872711dabaaf265d08b9bfbaa87)),
  closes [#52](https://code.castopod.org/adaures/castopod/issues/52)
- add where condition to get episode count without deleted episodes
  ([7661734](https://code.castopod.org/adaures/castopod/commit/7661734ed296654630f3668132671117519145dd)),
  closes [#67](https://code.castopod.org/adaures/castopod/issues/67)
- comment all cache clean after page update to prevent analytics cache deletion
  ([e6197a4](https://code.castopod.org/adaures/castopod/commit/e6197a4972a3cce3d67dd7972bb54f8720b8e5b7))
- correct chart data
  ([4d3e9c8](https://code.castopod.org/adaures/castopod/commit/4d3e9c8c02cdc882e9fe1c29625695b6f83c820a))
- correct percona compatibility issue
  ([e53f819](https://code.castopod.org/adaures/castopod/commit/e53f819264b2d6902996f11ffcbb7c99295a90ef))
- correct php-fpm issues
  ([1ef55d7](https://code.castopod.org/adaures/castopod/commit/1ef55d7315bb44abe05f02ec8a84b6b6a557a9a0))
- correct referrer bug
  ([ed69b2f](https://code.castopod.org/adaures/castopod/commit/ed69b2f5004ed1cd18bac824c08a0df01f5d2637))
- correction for servers with low int precision
  ([31b7828](https://code.castopod.org/adaures/castopod/commit/31b7828e77519ef43e9bcfcbdf6c21712f97a571))
- declare typed properties in PHPDoc for php<7.4
  ([14dd44d](https://code.castopod.org/adaures/castopod/commit/14dd44d03d6db0d9ae4198db8e65c92a0e45cb31)),
  closes [#23](https://code.castopod.org/adaures/castopod/issues/23)
- escape generated feed tag values and remove new lines from public pages meta
  description
  ([6238a43](https://code.castopod.org/adaures/castopod/commit/6238a43863210afe8988ad7cf251e6bfc6c8557c)),
  closes [#57](https://code.castopod.org/adaures/castopod/issues/57)
  [#46](https://code.castopod.org/adaures/castopod/issues/46)
- fix layout bugs in admin and update translation files
  ([a834171](https://code.castopod.org/adaures/castopod/commit/a83417180cf61cdfadc5509b0aaa2fdb66592be3)),
  closes [#40](https://code.castopod.org/adaures/castopod/issues/40)
- minor corrections
  ([13be386](https://code.castopod.org/adaures/castopod/commit/13be386842e94d9def1f7de4720931d8f6935171))
- move analytics to helper
  ([d311917](https://code.castopod.org/adaures/castopod/commit/d31191732e41aa106234b5ebe6e54ee02f0ce603))
- re-order graph values
  ([35f633b](https://code.castopod.org/adaures/castopod/commit/35f633b4c71c087d1ddc9bba9e9bbe18de09204f))
- remove required for other_categories field and add podcast_id to latest
  podcasts query
  ([5417be0](https://code.castopod.org/adaures/castopod/commit/5417be0049288489a19c7b575aa77bd1e2bc0243))
- rename issue_templates labels
  ([9f00305](https://code.castopod.org/adaures/castopod/commit/9f00305844e5a168e89d727fe29892b4ad5e48d6))
- rename MyAccount controller file
  ([e109df3](https://code.castopod.org/adaures/castopod/commit/e109df3004a3a98d72de39532e062fff9917f50f)),
  closes [#60](https://code.castopod.org/adaures/castopod/issues/60)
- reorder fields as composite primary keys for analytics tables
  ([9660aa9](https://code.castopod.org/adaures/castopod/commit/9660aa97c8ffd4fe61f3a388d52b9ac5dd8e1d63))
- replace website key for webpages in breadcrumb translate file
  ([50e32ff](https://code.castopod.org/adaures/castopod/commit/50e32ff75636c1d4c5d945a267e884cb26ad7191))
- set episode duration translation to hardcoded english
  ([c39efc9](https://code.castopod.org/adaures/castopod/commit/c39efc9489180662edcebd142d4476c0617ea97f)),
  closes [#64](https://code.castopod.org/adaures/castopod/issues/64)
- set episode guid upon episode creation
  ([ad8b153](https://code.castopod.org/adaures/castopod/commit/ad8b153f2a3b1a3b1751bf63785c4950e1516e6b)),
  closes [#48](https://code.castopod.org/adaures/castopod/issues/48)
- update purgecss content path for php helper files
  ([eb70bb4](https://code.castopod.org/adaures/castopod/commit/eb70bb4f7078ff347aeb8f5dcc7896311d289466)),
  closes [#59](https://code.castopod.org/adaures/castopod/issues/59)
- **install:** redirect to input baseUrl after instance config
  ([2426af7](https://code.castopod.org/adaures/castopod/commit/2426af7de8c9d426aaf534ff17b67f71c2e9f374)),
  closes [#53](https://code.castopod.org/adaures/castopod/issues/53)
- **platforms:** display platform link only when visible is toggled on
  ([6e503c8](https://code.castopod.org/adaures/castopod/commit/6e503c8d6182987e48892370623183f871bbd1c1)),
  closes [#39](https://code.castopod.org/adaures/castopod/issues/39)
- sort episodic podcasts by season
  ([d7b6794](https://code.castopod.org/adaures/castopod/commit/d7b6794f68f9a01fd606a407c6eb4c12d15dee74))
- update .htaccess for shared hosting config
  ([2379826](https://code.castopod.org/adaures/castopod/commit/2379826352e2f4b5060910bf9f29268610102f2e))
- update iso-369 language table seeder
  ([0c90db4](https://code.castopod.org/adaures/castopod/commit/0c90db44c40de5af5b0b32b54489bda9424d9ef6))
- **package.json:** update destination of postcss generation scripts
  ([21413f8](https://code.castopod.org/adaures/castopod/commit/21413f8af3b8a0ac01d8c6f15bcd7a63e524e964))
- use slash instead of backslash to call layout
  ([a80adb2](https://code.castopod.org/adaures/castopod/commit/a80adb22958fc0a38374cbce2d950a0042e699eb))

### Features

- add alternate rss feed link tag to podcast page head
  ([a973c09](https://code.castopod.org/adaures/castopod/commit/a973c097d54a3d0186c4079b9d4d3e81aae38505)),
  closes [#35](https://code.castopod.org/adaures/castopod/issues/35)
- add analytics and unknown useragents
  ([ec92e65](https://code.castopod.org/adaures/castopod/commit/ec92e65aa42e09b1df04600b52a0c679dfc494bb))
- add breadcrumb in admin area
  ([7fb1de2](https://code.castopod.org/adaures/castopod/commit/7fb1de2cf3c97c4cd7afe3bd71bbe66041786ecd)),
  closes [#17](https://code.castopod.org/adaures/castopod/issues/17)
- add french translation
  ([196920d](https://code.castopod.org/adaures/castopod/commit/196920d62f1810b4c35f800d17d7f93627319091))
- add install wizard form to bootstrap database and create the first superadmin
  user
  ([cba871c](https://code.castopod.org/adaures/castopod/commit/cba871c5df9f7120c44d9952456ebbd0d220669e)),
  closes [#2](https://code.castopod.org/adaures/castopod/issues/2)
- add ISO 3166 country codes
  ([97cd94b](https://code.castopod.org/adaures/castopod/commit/97cd94b47494b66faf43fbbe0748872da80020a4))
- add map analytics, add episodes analytics, clean analytics page layout,
  translate countries
  ([07eae83](https://code.castopod.org/adaures/castopod/commit/07eae83a00d860e149359fae67d549488403d88b))
- add npm for js dependencies + move src/ files to root folder
  ([cbb83a6](https://code.castopod.org/adaures/castopod/commit/cbb83a6f308ac9357e9fb0cca5edae9d3fee5b48))
- add pages table to store custom instance pages (eg. legal-notice, cookie
  policy, etc.)
  ([9c224a8](https://code.castopod.org/adaures/castopod/commit/9c224a8ac6dd95f3c6c087a300fc8bac48e8090f)),
  closes [#24](https://code.castopod.org/adaures/castopod/issues/24)
- add platform models
  ([a333d29](https://code.castopod.org/adaures/castopod/commit/a333d291966229a909c0851fd8b890ed97c48ceb))
- add platforms form in podcast settings
  ([043f49c](https://code.castopod.org/adaures/castopod/commit/043f49c784bc007ca0fa756ca4ed2d3b08843ad9))
- add platforms tables
  ([ce59344](https://code.castopod.org/adaures/castopod/commit/ce5934419a516c9926dd3fd0ace3c11a95b60722))
- add unique listeners analytics
  ([3a49258](https://code.castopod.org/adaures/castopod/commit/3a4925816f3268230640525ad7af507aab8eecb9))
- add user permissions and basic groups to handle authorizations
  ([d58e518](https://code.castopod.org/adaures/castopod/commit/d58e51874a4722921b75b0049117015c2380406e)),
  closes [#3](https://code.castopod.org/adaures/castopod/issues/3)
  [#18](https://code.castopod.org/adaures/castopod/issues/18)
- create optimized & resized images upon upload
  ([02e4441](https://code.castopod.org/adaures/castopod/commit/02e4441f98f27e9534e5b9b63279153d14632ccd)),
  closes [#6](https://code.castopod.org/adaures/castopod/issues/6)
- display legal disclaimer and warning on podcast import page
  ([2f07992](https://code.castopod.org/adaures/castopod/commit/2f07992e5508b34b91f194eebfac80c51e80e90a)),
  closes [#34](https://code.castopod.org/adaures/castopod/issues/34)
- edit + delete podcast and episode
  ([ac5f0c7](https://code.castopod.org/adaures/castopod/commit/ac5f0c732806e955c01e05b7867801bc938c6bd5))
- enhance admin ui with responsive design and ux improvements
  ([2d44b45](https://code.castopod.org/adaures/castopod/commit/2d44b457a02205d2e7da258d7029b8bc5da39533)),
  closes [#31](https://code.castopod.org/adaures/castopod/issues/31)
  [#9](https://code.castopod.org/adaures/castopod/issues/9)
- enhance ui using javascript in admin area
  ([c0e66d5](https://code.castopod.org/adaures/castopod/commit/c0e66d5f7012026e145d106f4d6bd3ba792a1b77))
- import podcast from an rss feed url
  ([9a5d5a1](https://code.castopod.org/adaures/castopod/commit/9a5d5a15b4945eb319da9e999c4ca60a0a4f6d2d)),
  closes [#21](https://code.castopod.org/adaures/castopod/issues/21)
- set podcast / episode description in the pages description meta tag
  ([1c4a504](https://code.castopod.org/adaures/castopod/commit/1c4a50442bea2d3449efce9c5ff1c80743152f55)),
  closes [#44](https://code.castopod.org/adaures/castopod/issues/44)
- update analytics so to meet IABv2 requirements
  ([03e23a2](https://code.castopod.org/adaures/castopod/commit/03e23a28bf9b1b73fba55352c36a8cd6cc8ae729)),
  closes [#10](https://code.castopod.org/adaures/castopod/issues/10)
- **cache:** add podcast and episode pages to cache + clear them after insert or
  update
  ([da0f047](https://code.castopod.org/adaures/castopod/commit/da0f0472819007e02e5da37399f2377772c618b9))
- **categories:** create model, entity, migrations and seeds
  ([f73b042](https://code.castopod.org/adaures/castopod/commit/f73b042cc091be82abdbbca8992080875d526972))
- **devcontainer:** add devcontainer settings for dev environment
  ([69e7266](https://code.castopod.org/adaures/castopod/commit/69e72667365247b63430dee88194e8f0d7c28edc))
- **episodes:** add create form and view pages for episode
  ([f3b2c8b](https://code.castopod.org/adaures/castopod/commit/f3b2c8b84f3d93bef734e34dbe8ed729535e45e9)),
  closes [#1](https://code.castopod.org/adaures/castopod/issues/1)
- **episodes:** add migrations, model and entity for episodes table
  ([0444821](https://code.castopod.org/adaures/castopod/commit/044482174ede555ce19a2d8c6f48771cc8e7d27b))
- **podcast:** create a podcast using form
  ([1202ba3](https://code.castopod.org/adaures/castopod/commit/1202ba3545f521097c60a6a2af95e70527cd1d34))
- **podcast-form:** update routes and redirect to podcast page
  ([12ce905](https://code.castopod.org/adaures/castopod/commit/12ce905799002dc9c07e6de092342d30ba9fd7d8))
- **public-ui:** adapt public podcast and episode pages to wireframes
  ([40a0535](https://code.castopod.org/adaures/castopod/commit/40a0535fc1bc12a24994b651f5e00b35995cbdda)),
  closes [#30](https://code.castopod.org/adaures/castopod/issues/30)
  [#13](https://code.castopod.org/adaures/castopod/issues/13)
- **rss:** generate rss feed from podcast entity
  ([c815ecd](https://code.castopod.org/adaures/castopod/commit/c815ecd6640931fee0895f80908a3ddfac482666))
- **users:** add myth-auth to handle users crud + add admin gateway only
  accessible by login
  ([c63a077](https://code.castopod.org/adaures/castopod/commit/c63a077618c61b4cde7f25ffc650a4b0e1495f44)),
  closes [#11](https://code.castopod.org/adaures/castopod/issues/11)
- minor corrections to some tables
  ([3bf9420](https://code.castopod.org/adaures/castopod/commit/3bf9420b5956a501b3b24405d243a71a928d6086))
- write id3v2 tags to episode's audio file
  ([4651d01](https://code.castopod.org/adaures/castopod/commit/4651d01a84ff3ea8433a8ae26cfd750a1ec9e88d))

### Reverts

- use basic input file for episodes audio files instead of button for better UX
  ([d5f22fb](https://code.castopod.org/adaures/castopod/commit/d5f22fbb38c43d9b37df401eff655958a57cb40a))
