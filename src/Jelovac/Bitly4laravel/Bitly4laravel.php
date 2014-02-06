<?php namespace Jelovac\Bitly4laravel;

class Bitly4laravel extends CallbackEngine implements CallbackInterface {

    public function init($accessToken = null, $format = null, $output = null)
    {
        if ($accessToken !== null) {
            $this->model->setAccessToken($accessToken);
        }
        if ($format !== null) {
            $this->model->setFormat($format);
        }
        if ($output !== null && is_bool($output)) {
            $this->model->setVariableOutput($output);
        }
    }

    public function bundleArchive(string $budleLink)
    {
        $this->setPostData('bundle_link', $budleLink);
        return $this->get('bundle/archive');
    }

    public function bundleBundlesByUser(string $user, boolean $expandUser = null)
    {
        $this->setPostData('user', $user);
        $this->setPostData('expand_user', $expandUser);
        return $this->get('bundle/bundles_by_user');
    }

    public function bundleClone(string $budleLink)
    {
        $this->setPostData('bundle_link', $budleLink);
        return $this->get('bundle/clone');
    }

    public function bundleCollaboratorAdd(string $budleLink, string $collaborator)
    {
        $this->setPostData('bundle_link', $budleLink);
        $this->setPostData('collaborator', $collaborator);
        return $this->get('bundle/collaborator_add');
    }

    public function bundleCollaboratorRemove(string $budleLink, string $collaborator)
    {
        $this->setPostData('bundle_link', $budleLink);
        $this->setPostData('collaborator', $collaborator);
        return $this->get('bundle/collaborator_remove');
    }

    public function bundleContents(string $bundleLink, boolean $expandUser = null)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('expand_user', $expandUser);
        return $this->get('bundle/contents');
    }

    public function bundleCreate(boolean $private = null, string $title = null, string $description = null)
    {
        $this->setPostData('private', $private);
        $this->setPostData('title', $title);
        $this->setPostData('description', $description);
        return $this->get('bundle/create');
    }

    public function bundleEdit(string $bundleLink, string $edit = null, string $title = null, string $description = null, boolean $private = null, boolean $preview = null, string $ogImage = null)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('edit', $edit);
        $this->setPostData('title', $title);
        $this->setPostData('description', $description);
        $this->setPostData('private', $private);
        $this->setPostData('preview', $preview);
        $this->setPostData('og_image', $ogImage);
        return $this->get('bundle/edit');
    }

    public function bundleHistory(boolean $expandUser = null)
    {
        $this->setPostData('expand_user', $expandUser);
        return $this->get('bundle/history');
    }

    public function bundleLinkAdd(string $bundleLink, string $link, string $title = null)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('title', $title);
        return $this->get('bundle/link_add');
    }

    public function bundleLinkCommentAdd(string $bundleLink, string $link, string $comment)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('comment', $comment);
        return $this->get('bundle/link_comment_add');
    }

    public function bundleLinkCommentEdit(string $bundleLink, string $link, integer $commentId, string $comment)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('comment_id', $commentId);
        $this->setPostData('comment', $comment);
        return $this->get('bundle/link_comment_edit');
    }

    public function bundleLinkCommentRemove(string $bundleLink, string $link, integer $commentId)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('comment_id', $commentId);
        return $this->get('bundle/link_comment_remove');
    }

    public function bundleLinkEdit(string $bundleLink, string $link, string $edit, string $title = null, boolean $preview = null)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('edit', $edit);
        $this->setPostData('title', $title);
        $this->setPostData('preview', $preview);
        return $this->get('bundle/link_edit');
    }

    public function bundleLinkRemove(string $bundleLink, string $link)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        return $this->get('bundle/link_remove');
    }

    public function bundleLinkReorder(string $bundleLink, string $link, integer $displayOrder)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('display_order', $displayOrder);
        return $this->get('bundle/link_reorder');
    }

    public function bundlePendingCollaboratorRemove(string $bundleLink, string $collaborator)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('collaborator', $collaborator);
        return $this->get('bundle/pending_collaborator_remove');
    }

    public function bundleReorder(string $bundleLink, string $link)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        return $this->get('bundle/reorder');
    }

    public function bundleViewCount(string $bundleLink)
    {
        $this->setPostData('bundle_link', $bundleLink);
        return $this->get('bundle/view_count');
    }

    public function expand(string $shortURL, string $hash)
    {
        $this->setPostData('shortUrl', $shortURL);
        $this->setPostData('hash', $hash);
        return $this->get('expand');
    }

    public function highvalue(integer $limit)
    {
        $this->setPostData('limit', $limit);
        return $this->get('highvalue');
    }

    public function info(string $hash, string $shortURL, boolean $expandUser)
    {
        $this->setPostData('shortUrl', $shortURL);
        $this->setPostData('hash', $hash);
        $this->setPostData('expand_user', $expandUser);
        return $this->get('info');
    }

    public function linkCategory(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/category');
    }

    public function linkClicks(string $link, string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('link', $link);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('rollup', $rollup);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/clicks');
    }

    public function linkContent(string $link, string $contentType)
    {
        $this->setPostData('link', $link);
        $this->setPostData('content_type', $contentType);
        return $this->get('link/content');
    }

    public function linkCountries(string $link, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('link', $link);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/countries');
    }

    public function linkEncoders(string $link, boolean $myNetwork = null, boolean $subaccounts = null, integer $limit = null, boolean $expandUser = null)
    {
        $this->setPostData('link', $link);
        $this->setPostData('my_network', $myNetwork);
        $this->setPostData('subaccounts', $subaccounts);
        $this->setPostData('limit', $limit);
        $this->setPostData('expand_user', $expandUser);
        return $this->get('link/encoders');
    }

    public function linkEncodersByCount(string $link, boolean $myNetwork = null, boolean $subaccounts = null, integer $limit = null, boolean $expandUser = null)
    {
        $this->setPostData('link', $link);
        $this->setPostData('my_network', $myNetwork);
        $this->setPostData('subaccounts', $subaccounts);
        $this->setPostData('limit', $limit);
        $this->setPostData('expand_user', $expandUser);
        return $this->get('link/encoders_by_count');
    }

    public function linkEncodersCount(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/encoders_count');
    }

    public function linkInfo(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/info');
    }

    public function linkLanguage(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/language');
    }

    public function linkLocation(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/location');
    }

    public function linkLookup(string $url)
    {
        $this->setPostData('url', $url);
        return $this->get('link/lookup');
    }

    public function linkReferrers(string $link, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('link', $link);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/referrers');
    }

    public function linkReferrersByDomain(string $link, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('link', $link);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/referrers_by_domain');
    }

    public function linkReferringDomains(string $link, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('link', $link);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/referring_domains');
    }

    public function linkShares(string $link, string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('link', $link);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('rollup', $rollup);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/shares');
    }

    public function linkSocial(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/social');
    }

    public function oAuthApp(string $clientId)
    {
        $this->setPostData('client_id', $clientId);
        return $this->get('oauth/app');
    }

    public function organizationBrandMessages(string $domain, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('domain', $domain);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('organization/brand_messages');
    }

    public function organizationIntersectingLinks(string $domain, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('domain', $domain);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('organization/interesecting_links');
    }

    public function organizationLeaderboard(string $domain, string $orderBy, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('domain', $domain);
        $this->setPostData('order_by', $orderBy);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('organization/leaderboard');
    }

    public function organizationMissedOpportunities(string $domain, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('domain', $domain);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('organization/missed_opportunities');
    }

    public function realtimeBurstingPhrases()
    {
        return $this->get('realtime/bursting_phrases');
    }

    public function realtimeClickrate(string $phrase)
    {
        $this->setPostData('phrase', $phrase);
        return $this->get('realtime/clickrate');
    }

    public function realtimeHotPhrases()
    {
        return $this->get('realtime/hot_phrases');
    }

    public function search(string $query, string $fields, integer $offset, integer $limit, string $domain, string $fullDomain, string $cities, string $lang)
    {
        $this->setPostData('query', $query);
        $this->setPostData('fields', $fields);
        $this->setPostData('offset', $offset);
        $this->setPostData('limit', $limit);
        $this->setPostData('domain', $domain);
        $this->setPostData('full_domain', $fullDomain);
        $this->setPostData('cities', $cities);
        $this->setPostData('lang', $lang);
        return $this->get('search');
    }

    public function shorten(string $longURL, $domain = null)
    {
        $this->setPostData('longUrl', $longURL);
        $this->setPostData('domain', $domain);
        return $this->get('shorten');
    }

    public function userClicks(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('rollup', $rollup);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/clicks');
    }

    public function userCountries(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('rollup', $rollup);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/countries');
    }

    public function userInfo(string $login = null, string $fullName = null)
    {
        $this->setPostData('login', $login);
        $this->setPostData('full_name', $fullName);
        return $this->get('user/info');
    }

    public function userLinkEdit(string $link, string $edit, string $title = null, string $note = null, boolean $private = null, integer $userTimeStamp = null, boolean $archived = null)
    {
        $this->setPostData('link', $link);
        $this->setPostData('edit', $edit);
        $this->setPostData('title', $title);
        $this->setPostData('note', $note);
        $this->setPostData('private', $private);
        $this->setPostData('user_ts', $userTimeStamp);
        $this->setPostData('archived', $archived);
        return $this->get('user/link_edit');
    }

    public function userLinkHistory(string $link = null, string $query = null, integer $offset = null, integer $limit = null, integer $createdBefore = null, integer $createdAfter = null, integer $modifiedAfter = null, boolean $expandClientId = null, string $archived = null, string $private = null, string $user = null, string $exactDomain = null, string $rootDomain = null)
    {
        $this->setPostData('link', $link);
        $this->setPostData('query', $query);
        $this->setPostData('offset', $offset);
        $this->setPostData('limit', $limit);
        $this->setPostData('created_before', $createdBefore);
        $this->setPostData('created_after', $createdAfter);
        $this->setPostData('modified_after', $modifiedAfter);
        $this->setPostData('expand_client_id', $expandClientId);
        $this->setPostData('archived', $archived);
        $this->setPostData('private', $private);
        $this->setPostData('offset', $offset);
        $this->setPostData('user', $user);
        $this->setPostData('exact_domain', $exactDomain);
        $this->setPostData('root_domain', $rootDomain);
        return $this->get('user/link_history');
    }

    public function userLinkLookup(string $url)
    {
        $this->setPostData('url', $url);
        return $this->get('user/link_lookup');
    }

    public function userLinkSave(string $longURL, string $title = null, string $note = null, boolean $private = null, integer $userTimeStamp = null)
    {
        $this->setPostData('longUrl', $longURL);
        $this->setPostData('title', $title);
        $this->setPostData('note', $note);
        $this->setPostData('private', $private);
        $this->setPostData('user_ts', $userTimeStamp);
        return $this->get('user/link_save');
    }

    public function userNetworkHistory(integer $offset = null, boolean $expandClientId = null, integer $limit = null, boolean $expandUser = null)
    {
        $this->setPostData('offset', $offset);
        $this->setPostData('expand_client_id', $expandClientId);
        $this->setPostData('limit', $limit);
        $this->setPostData('expand_user', $expandUser);
        return $this->get('user/newtork_history');
    }

    public function userPopularEarnedByClicks(string $domain, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('domain', $domain);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/popular_earned_by_clicks');
    }

    public function userPopularEarnedByShortens(string $domain, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('domain', $domain);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/popular_earned_by_shortens');
    }

    public function userPopularLinks(string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/popular_links');
    }

    public function userPopularOwnedByClicks(string $domain, string $subaccount, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('domain', $domain);
        $this->setPostData('subaccount', $subaccount);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/popular_owned_by_clicks');
    }

    public function userPopularOwnedByShortens(string $domain, string $subaccount, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('domain', $domain);
        $this->setPostData('subaccount', $subaccount);
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/popular_owned_by_shortens');
    }

    public function userReferrers(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('rollup', $rollup);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/referrers');
    }

    public function userReferringDomains(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('rollup', $rollup);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/referring_domains');
    }

    public function userSaveCustomDomainKeyword(string $keywordLink, string $targetLink)
    {
        $this->setPostData('keyword_link', $keywordLink);
        $this->setPostData('target_link', $targetLink);
        return $this->get('user/save_custom_domain_keyword');
    }

    public function userShareCounts(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('rollup', $rollup);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/share_counts');
    }

    public function userShareCountsByShareType(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('rollup', $rollup);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/share_counts_by_share_type');
    }

    public function userShortenCounts(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('rollup', $rollup);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/shorten_counts');
    }

    public function userTrackingDomainList()
    {
        return $this->get('user/tracking_domain_list');
    }

}