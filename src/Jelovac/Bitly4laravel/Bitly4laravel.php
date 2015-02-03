<?php namespace Jelovac\Bitly4laravel;

class Bitly4laravel extends API implements BitlyInterface {

    /**
     * Archive a bundle for the authenticated user. Only a bundle's owner is allowed to archive a bundle.
     *
     * @param string $budleLink
     * @return type
     */
    public function bundleArchive($budleLink)
    {
        $this->setRequestParam('bundle_link', $budleLink);
        return $this->get('bundle/archive');
    }

    /**
     * Returns a list of public bundles created by a user.
     *
     * @param string $user
     * @param boolean $expandUser
     * @return type
     */
    public function bundleBundlesByUser($user, $expandUser = null)
    {
        $this->setRequestParam('user', $user);
        $this->setRequestParam('expand_user', $expandUser);
        return $this->get('bundle/bundles_by_user');
    }

    /**
     * Clone a bundle for the authenticated user.
     *
     * @param string $budleLink
     * @return type
     */
    public function bundleClone($budleLink)
    {
        $this->setRequestParam('bundle_link', $budleLink);
        return $this->get('bundle/clone');
    }

    /**
     * Add a collaborator to a bundle.
     *
     * @param string $budleLink
     * @param string $collaborator
     * @return type
     */
    public function bundleCollaboratorAdd($budleLink, $collaborator)
    {
        $this->setRequestParam('bundle_link', $budleLink);
        $this->setRequestParam('collaborator', $collaborator);
        return $this->get('bundle/collaborator_add');
    }

    /**
     * Remove a collaborator from a bundle.
     *
     * @param string $budleLink
     * @param string $collaborator
     * @return type
     */
    public function bundleCollaboratorRemove($budleLink, $collaborator)
    {
        $this->setRequestParam('bundle_link', $budleLink);
        $this->setRequestParam('collaborator', $collaborator);
        return $this->get('bundle/collaborator_remove');
    }

    /**
     * Returns information about a bundle.
     *
     * @param string $bundleLink
     * @param boolean $expandUser
     * @return type
     */
    public function bundleContents($bundleLink, $expandUser = null)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('expand_user', $expandUser);
        return $this->get('bundle/contents');
    }

    /**
     * Create a new bundle for the authenticated user.
     *
     * @param boolean $private
     * @param string $title
     * @param string $description
     * @return type
     */
    public function bundleCreate($private = null, $title = null, $description = null)
    {
        $this->setRequestParam('private', $private);
        $this->setRequestParam('title', $title);
        $this->setRequestParam('description', $description);
        return $this->get('bundle/create');
    }

    /**
     * Edit a bundle for the authenticated user
     *
     * @param string $bundleLink
     * @param string $edit
     * @param string $title
     * @param string $description
     * @param boolean $private
     * @param boolean $preview
     * @param string $ogImage
     * @return type
     */
    public function bundleEdit($bundleLink, $edit = null, $title = null, $description = null, $private = null, $preview = null, $ogImage = null)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('edit', $edit);
        $this->setRequestParam('title', $title);
        $this->setRequestParam('description', $description);
        $this->setRequestParam('private', $private);
        $this->setRequestParam('preview', $preview);
        $this->setRequestParam('og_image', $ogImage);
        return $this->get('bundle/edit');
    }

    /**
     * Returns all bundles this user has access to (public + private + collaborator).
     *
     * @param boolean $expandUser
     * @return type
     */
    public function userBundleHistory($expandUser = null)
    {
        $this->setRequestParam('expand_user', $expandUser);
        return $this->get('user/bundle_history');
    }

    /**
     * Adds a link to a bitly bundle. Links are automatically added to the top (position 0) of a bundle.
     *
     * @param string $bundleLink
     * @param string $link
     * @param string $title
     * @return type
     */
    public function bundleLinkAdd($bundleLink, $link, $title = null)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('link', $link);
        $this->setRequestParam('title', $title);
        return $this->get('bundle/link_add');
    }

    /**
     * Add a comment to bundle item.
     *
     * @param string $bundleLink
     * @param string $link
     * @param string $comment
     * @return type
     */
    public function bundleLinkCommentAdd($bundleLink, $link, $comment)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('link', $link);
        $this->setRequestParam('comment', $comment);
        return $this->get('bundle/link_comment_add');
    }

    /**
     * Add a comment to bundle item.
     *
     * @param string $bundleLink
     * @param string $link
     * @param integer $commentId
     * @param string $comment
     * @return type
     */
    public function bundleLinkCommentEdit($bundleLink, $link, $commentId, $comment)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('link', $link);
        $this->setRequestParam('comment_id', $commentId);
        $this->setRequestParam('comment', $comment);
        return $this->get('bundle/link_comment_edit');
    }

    /**
     * Remove a comment from a bundle item. Only the original commenter and the bundles owner may perform this action.
     *
     * @param string $bundleLink
     * @param string $link
     * @param integer $commentId
     * @return type
     */
    public function bundleLinkCommentRemove($bundleLink, $link, $commentId)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('link', $link);
        $this->setRequestParam('comment_id', $commentId);
        return $this->get('bundle/link_comment_remove');
    }

    /**
     * Edit the title for a link.
     *
     * @param string $bundleLink
     * @param string $link
     * @param string $edit
     * @param string $title
     * @param boolean $preview
     * @return type
     */
    public function bundleLinkEdit($bundleLink, $link, $edit, $title = null, $preview = null)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('link', $link);
        $this->setRequestParam('edit', $edit);
        $this->setRequestParam('title', $title);
        $this->setRequestParam('preview', $preview);
        return $this->get('bundle/link_edit');
    }

    /**
     * Remove a link from a bitly bundle
     *
     * @param string $bundleLink
     * @param string $link
     * @return type
     */
    public function bundleLinkRemove($bundleLink, $link)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('link', $link);
        return $this->get('bundle/link_remove');
    }

    /**
     * Change the position of a link in a bitly bundle.
     *
     * @param string $bundleLink
     * @param string $link
     * @param integer $displayOrder
     * @return type
     */
    public function bundleLinkReorder($bundleLink, $link, $displayOrder)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('link', $link);
        $this->setRequestParam('display_order', $displayOrder);
        return $this->get('bundle/link_reorder');
    }

    /**
     * Removes a pending/invited collaborator from a bundle.
     *
     * @param string $bundleLink
     * @param string $collaborator
     * @return type
     */
    public function bundlePendingCollaboratorRemove($bundleLink, $collaborator)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('collaborator', $collaborator);
        return $this->get('bundle/pending_collaborator_remove');
    }

    /**
     * Re-order the links in a bundle.
     *
     * @param string $bundleLink
     * @param string $link
     * @return type
     */
    public function bundleReorder($bundleLink, $link)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        $this->setRequestParam('link', $link);
        return $this->get('bundle/reorder');
    }

    /**
     * Get the number of views for a bundle.
     *
     * @param string $bundleLink
     * @return type
     */
    public function bundleViewCount($bundleLink)
    {
        $this->setRequestParam('bundle_link', $bundleLink);
        return $this->get('bundle/view_count');
    }

    /**
     * Given a bitly URL or hash (or multiple), returns the target (long) URL.
     *
     * @param string $shortURLOrHash
     * @return type
     */
    public function expand($shortURLOrHash)
    {
        if (filter_var($shortURLOrHash, FILTER_VALIDATE_URL) === true) {
            $this->setRequestParam('shortUrl', $shortURLOrHash);
        } else {
            $this->setRequestParam('hash', $shortURLOrHash);
        }
        return $this->get('expand');
    }

    /**
     * Returns a specified number of "high-value" bitly links that are popular across bitly at this particular moment.
     *
     * @param integer $limit
     * @return type
     */
    public function highvalue($limit)
    {
        $this->setRequestParam('limit', $limit);
        return $this->get('highvalue');
    }

    /**
     * This is used to return the page title for a given bitly link.
     *
     * @param string $hash
     * @param string $shortURL
     * @param boolean $expandUser
     * @return type
     */
    public function info($hash, $shortURL, $expandUser)
    {
        $this->setRequestParam('shortUrl', $shortURL);
        $this->setRequestParam('hash', $hash);
        $this->setRequestParam('expand_user', $expandUser);
        return $this->get('info');
    }

    /**
     * Returns the detected categories for a document, in descending order of confidence.
     *
     * @param string $link
     * @return type
     */
    public function linkCategory($link)
    {
        $this->setRequestParam('link', $link);
        return $this->get('link/category');
    }

    /**
     * Returns the number of clicks on a single bitly link.
     *
     * @param string $link
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function linkClicks($link, $unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('rollup', $rollup);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/clicks');
    }

    /**
     * Returns the “main article” from the linked page, as determined by the content extractor, in either HTML or plain text format.
     *
     * @param string $link
     * @param string $contentType
     * @return type
     */
    public function linkContent($link, $contentType)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('content_type', $contentType);
        return $this->get('link/content');
    }

    /**
     * Returns metrics about the countries referring click traffic to a single bitly link.
     *
     * @param string $link
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function linkCountries($link, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/countries');
    }

    /**
     * Returns users who have encoded this link (optionally only those in the requesting user's social graph).
     * Note: Some users may not be returned from this call depending on link privacy settings.
     *
     * @param string $link
     * @param boolean $myNetwork
     * @param boolean $subaccounts
     * @param integer $limit
     * @param boolean $expandUser
     * @return type
     */
    public function linkEncoders($link, $myNetwork = null, $subaccounts = null, $limit = null, $expandUser = null)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('my_network', $myNetwork);
        $this->setRequestParam('subaccounts', $subaccounts);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('expand_user', $expandUser);
        return $this->get('link/encoders');
    }

    /**
     * Returns users who have encoded this link (optionally only those in the requesting user's social graph), sorted by the number of clicks on each encoding user's link.
     * Note: The response will only contain users whose links have gotten at least one click, and will not contain any users whose links are private.
     *
     * @param string $link
     * @param boolean $myNetwork
     * @param boolean $subaccounts
     * @param integer $limit
     * @param boolean $expandUser
     * @return type
     */
    public function linkEncodersByCount($link, $myNetwork = null, $subaccounts = null, $limit = null, $expandUser = null)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('my_network', $myNetwork);
        $this->setRequestParam('subaccounts', $subaccounts);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('expand_user', $expandUser);
        return $this->get('link/encoders_by_count');
    }

    /**
     * Returns the number of users who have shortened (encoded) a single bitly link.
     *
     * @param string $link
     * @return type
     */
    public function linkEncodersCount($link)
    {
        $this->setRequestParam('link', $link);
        return $this->get('link/encoders_count');
    }

    /**
     * Returns metadata about a single bitly link.
     *
     * @param string $link
     * @return type
     */
    public function linkInfo($link)
    {
        $this->setRequestParam('link', $link);
        return $this->get('link/info');
    }

    /**
     * Returns the significant languages for the bitly link. Note that languages are highly dependent upon activity (clicks) occurring on the bitly link. If there have not been clicks on a bitly link within the last 24 hours, it is possible that language data for that link does not exist.
     *
     * @param string $link
     * @return type
     */
    public function linkLanguage($link)
    {
        $this->setRequestParam('link', $link);
        return $this->get('link/language');
    }

    /**
     * Returns the significant locations for the bitly link or None if locations do not exist. Note that locations are highly dependent upon activity (clicks) occurring on the bitly link. If there have not been clicks on a bitly link within the last 24 hours, it is possible that location data for that link does not exist.
     *
     * @param string $link
     * @return type
     */
    public function linkLocation($link)
    {
        $this->setRequestParam('link', $link);
        return $this->get('link/location');
    }

    /**
     * This is used to query for a bitly link based on a long URL.
     *
     * @param string $url
     * @return type
     */
    public function linkLookup($url)
    {
        $this->setRequestParam('url', $url);
        return $this->get('link/lookup');
    }

    /**
     *
     * Returns metrics about the pages referring click traffic to a single bitly link.
     *
     * @param string $link
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function linkReferrers($link, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/referrers');
    }

    /**
     * Returns metrics about the pages referring click traffic to a single bitly link, grouped by referring domain.
     *
     * @param string $link
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function linkReferrersByDomain($link, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/referrers_by_domain');
    }

    /**
     * Returns metrics about the domains referring click traffic to a single bitly link.
     *
     * @param string $link
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function linkReferringDomains($link, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/referring_domains');
    }

    /**
     * Returns metrics about a shares of a single link.
     *
     * @param string $link
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function linkShares($link, $unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('rollup', $rollup);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('link/shares');
    }

    /**
     * Returns the "social score" for a specified bitly link. Note that the social score are highly dependent upon activity (clicks) occurring on the bitly link. If there have not been clicks on a bitly link within the last 24 hours, it is possible a social score for that link does not exist.
     *
     * @param string $link
     * @return type
     */
    public function linkSocial($link)
    {
        $this->setRequestParam('link', $link);
        return $this->get('link/social');
    }

    /**
     * Return information about an OAuth app.
     *
     * @param string $clientId
     * @return type
     */
    public function oAuthApp($clientId)
    {
        $this->setRequestParam('client_id', $clientId);
        return $this->get('oauth/app');
    }

    /**
     * Returns the top links shared by you, but not by your audience, ordered by clicks.
     * This endpoint is only available to paid customers.
     *
     * @param string $domain
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function organizationBrandMessages($domain, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('domain', $domain);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('organization/brand_messages');
    }

    /**
     * Returns the top links shared by both your audience and by your account, ordered by clicks.
     * This endpoint is only available to paid customers.
     *
     * @param string $domain
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function organizationIntersectingLinks($domain, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('domain', $domain);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('organization/interesecting_links');
    }

    /**
     * Returns the top-performing organization members ordered by clicks or shortens.
     * This endpoint is only available to paid customers.
     *
     * @param string $domain
     * @param string $orderBy
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function organizationLeaderboard($domain, $orderBy, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('domain', $domain);
        $this->setRequestParam('order_by', $orderBy);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('organization/leaderboard');
    }

    /**
     * Returns the top links shared by your audience, but not by you, ordered by clicks.
     * This endpoint is only available to paid customers.
     *
     * @param string $domain
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function organizationMissedOpportunities($domain, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('domain', $domain);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('organization/missed_opportunities');
    }

    /**
     * Returns phrases that are receiving an uncharacteristically high volume of click traffic, and the individual links (hashes) driving traffic to pages containing these phrases.
     *
     * @return type
     */
    public function realtimeBurstingPhrases()
    {
        return $this->get('realtime/bursting_phrases');
    }

    /**
     * Returns the click rate for content containing a specified phrase.
     *
     * @param string $phrase
     * @return type
     */
    public function realtimeClickrate($phrase)
    {
        $this->setRequestParam('phrase', $phrase);
        return $this->get('realtime/clickrate');
    }

    /**
     * Returns phrases that are receiving a consistently high volume of click traffic, and the individual links (hashes) driving traffic to pages containing these phrases.
     *
     * @return type
     */
    public function realtimeHotPhrases()
    {
        return $this->get('realtime/hot_phrases');
    }

    /**
     * Search links receiving clicks across bitly by content, language, location, and more.
     *
     * @param string $query
     * @param string $fields
     * @param integer $offset
     * @param integer $limit
     * @param string $domain
     * @param string $fullDomain
     * @param string $cities
     * @param string $lang
     * @return type
     */
    public function search($query, $fields, $offset, $limit, $domain, $fullDomain, $cities, $lang)
    {
        $this->setRequestParam('query', $query);
        $this->setRequestParam('fields', $fields);
        $this->setRequestParam('offset', $offset);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('domain', $domain);
        $this->setRequestParam('full_domain', $fullDomain);
        $this->setRequestParam('cities', $cities);
        $this->setRequestParam('lang', $lang);
        return $this->get('search');
    }

    /**
     * Given a long URL, returns a bitly short URL.
     *
     * @param string $longURL
     * @param type $domain
     * @return type
     */
    public function shorten($longURL, $domain = null)
    {
        $this->setRequestParam('longUrl', $longURL);
        $this->setRequestParam('domain', $domain);
        return $this->get('shorten');
    }

    /**
     * Returns the aggregate number of clicks on all of the authenticated user's bitly links.
     *
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userClicks($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('rollup', $rollup);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/clicks');
    }

    /**
     * Returns aggregate metrics about the countries referring click traffic to all of the authenticated user's bitly links.
     *
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userCountries($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('rollup', $rollup);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/countries');
    }

    /**
     * Return or update information about a user.
     *
     * @param string $login
     * @param string $fullName
     * @return type
     */
    public function userInfo($login = null, $fullName = null)
    {
        $this->setRequestParam('login', $login);
        $this->setRequestParam('full_name', $fullName);
        return $this->get('user/info');
    }

    /**
     * Changes link metadata in a user's history.
     *
     * @param string $link
     * @param string $edit
     * @param string $title
     * @param string $note
     * @param boolean $private
     * @param integer $userTimeStamp
     * @param boolean $archived
     * @return type
     */
    public function userLinkEdit($link, $edit, $title = null, $note = null, $private = null, $userTimeStamp = null, $archived = null)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('edit', $edit);
        $this->setRequestParam('title', $title);
        $this->setRequestParam('note', $note);
        $this->setRequestParam('private', $private);
        $this->setRequestParam('user_ts', $userTimeStamp);
        $this->setRequestParam('archived', $archived);
        return $this->get('user/link_edit');
    }

    /**
     * Returns entries from a user's link history in reverse chronological order.
     * Note: Entries will be sorted by the user_ts field found in the response data.
     *
     * @param string $link
     * @param string $query
     * @param integer $offset
     * @param integer $limit
     * @param integer $createdBefore
     * @param integer $createdAfter
     * @param integer $modifiedAfter
     * @param boolean $expandClientId
     * @param string $archived
     * @param string $private
     * @param string $user
     * @param string $exactDomain
     * @param string $rootDomain
     * @return type
     */
    public function userLinkHistory($link = null, $query = null, $offset = null, $limit = null, $createdBefore = null, $createdAfter = null, $modifiedAfter = null, $expandClientId = null, $archived = null, $private = null, $user = null, $exactDomain = null, $rootDomain = null)
    {
        $this->setRequestParam('link', $link);
        $this->setRequestParam('query', $query);
        $this->setRequestParam('offset', $offset);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('created_before', $createdBefore);
        $this->setRequestParam('created_after', $createdAfter);
        $this->setRequestParam('modified_after', $modifiedAfter);
        $this->setRequestParam('expand_client_id', $expandClientId);
        $this->setRequestParam('archived', $archived);
        $this->setRequestParam('private', $private);
        $this->setRequestParam('offset', $offset);
        $this->setRequestParam('user', $user);
        $this->setRequestParam('exact_domain', $exactDomain);
        $this->setRequestParam('root_domain', $rootDomain);
        return $this->get('user/link_history');
    }

    /**
     * This is used to query for a bitly link shortened by the authenticated user based on a long URL.
     *
     * @param string $url
     * @return type
     */
    public function userLinkLookup($url)
    {
        $this->setRequestParam('url', $url);
        return $this->get('user/link_lookup');
    }

    /**
     * Saves a link as a bitmark in a user's history, with optional pre-set metadata. (Also returns a short URL for that link.)
     *
     * @param string $longURL
     * @param string $title
     * @param string $note
     * @param boolean $private
     * @param integer $userTimeStamp
     * @return type
     */
    public function userLinkSave($longURL, $title = null, $note = null, $private = null, $userTimeStamp = null)
    {
        $this->setRequestParam('longUrl', $longURL);
        $this->setRequestParam('title', $title);
        $this->setRequestParam('note', $note);
        $this->setRequestParam('private', $private);
        $this->setRequestParam('user_ts', $userTimeStamp);
        return $this->get('user/link_save');
    }

    /**
     * Returns entries from a user's network history in reverse chronogical order. (A user's network history includes publicly saved links from Twitter and Facebook connections.)
     *
     * @param integer $offset
     * @param boolean $expandClientId
     * @param integer $limit
     * @param boolean $expandUser
     * @return type
     */
    public function userNetworkHistory($offset = null, $expandClientId = null, $limit = null, $expandUser = null)
    {
        $this->setRequestParam('offset', $offset);
        $this->setRequestParam('expand_client_id', $expandClientId);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('expand_user', $expandUser);
        return $this->get('user/newtork_history');
    }

    /**
     * Returns the top links to your tracking domain (or domains) created by users not associated with your account, ordered by clicks.
     * Users can register a tracking domain from their bitly settings page.
     * This endpoint is only available to paid customers.
     *
     * @param string $domain
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userPopularEarnedByClicks($domain, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('domain', $domain);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/popular_earned_by_clicks');
    }

    /**
     * Returns the top links to your tracking domain (or domains) created by users not associated with your account, ordered by shortens.
     * Users can register a tracking domain from their bitly settings page.
     * This endpoint is only available to paid customers.
     *
     * @param string $domain
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userPopularEarnedByShortens($domain, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('domain', $domain);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/popular_earned_by_shortens');
    }

    /**
     * Returns the authenticated user's most-clicked bitly links (ordered by number of clicks) in a given time period.
     * Note: This replaces the realtime_links endpoint.
     *
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userPopularLinks($unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/popular_links');
    }

    /**
     * Returns the top links to your tracking domain (or domains) created by you or your subaccounts ordered by clicks.
     * Users can register a tracking domain from their bitly settings page.
     * This endpoint is only available to paid customers.
     *
     * @param string $domain
     * @param string $subaccount
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userPopularOwnedByClicks($domain, $subaccount, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('domain', $domain);
        $this->setRequestParam('subaccount', $subaccount);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/popular_owned_by_clicks');
    }

    /**
     * Returns the top links to your tracking domain (or domains) created by you or your subaccounts ordered by number of shortens.
     * Users can register a tracking domain from their bitly settings page.
     * This endpoint is only available to paid customers.
     *
     * @param string $domain
     * @param string $subaccount
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userPopularOwnedByShortens($domain, $subaccount, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('domain', $domain);
        $this->setRequestParam('subaccount', $subaccount);
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/popular_owned_by_shortens');
    }

    /**
     * Returns aggregate metrics about the pages referring click traffic to all of the authenticated user's bitly links.
     *
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userReferrers($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('rollup', $rollup);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/referrers');
    }

    /**
     * Returns aggregate metrics about the domains referring click traffic to all of the authenticated user's bitly links.
     *
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userReferringDomains($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('rollup', $rollup);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/referring_domains');
    }

    /**
     * Save a custom keyword for a custom short domain.
     *
     * @param string $keywordLink
     * @param string $targetLink
     * @return type
     */
    public function userSaveCustomDomainKeyword($keywordLink, $targetLink)
    {
        $this->setRequestParam('keyword_link', $keywordLink);
        $this->setRequestParam('target_link', $targetLink);
        return $this->get('user/save_custom_domain_keyword');
    }

    /**
     * Returns the number of shares by the authenticated user in a given time period.
     *
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userShareCounts($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('rollup', $rollup);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/share_counts');
    }

    /**
     * Returns the number of shares by the authenticated user, broken down by share type (ie: twitter, facebook, email) in a given time period.
     *
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userShareCountsByShareType($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('rollup', $rollup);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/share_counts_by_share_type');
    }

    /**
     * Returns the number of links shortened (encoded) in a given time period by the authenticated user.
     *
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userShortenCounts($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp)
    {
        $this->setRequestParam('unit', $unit);
        $this->setRequestParam('units', $units);
        $this->setRequestParam('timezone', $timezone);
        $this->setRequestParam('rollup', $rollup);
        $this->setRequestParam('limit', $limit);
        $this->setRequestParam('unit_reference_ts', $unitReferenceTimeStamp);
        return $this->get('user/shorten_counts');
    }

    /**
     * Returns a list of tracking domains a user has configured.
     *
     * @return type
     */
    public function userTrackingDomainList()
    {
        return $this->get('user/tracking_domain_list');
    }

}
