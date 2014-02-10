<?php namespace Jelovac\Bitly4laravel;

class Bitly4laravel extends CallbackEngine implements CallbackInterface {

    /**
     * Set Generic oAuth Access Token
     * 
     * @param string $accessToken
     * @return \Jelovac\Bitly4laravel\Bitly4laravel
     */
    public function setAccessToken(string $accessToken)
    {
        $this->model->setAccessToken($accessToken);
        return $this;
    }

    /**
     * Set response format
     * 
     * @param string $format
     * @return \Jelovac\Bitly4laravel\Bitly4laravel
     */
    public function setFormat(string $format)
    {
        $this->model->setFormat($format);
        return $this;
    }

    /**
     * Set variable output type: array, json object, string
     * 
     * @param string $variableOutput
     * @return \Jelovac\Bitly4laravel\Bitly4laravel
     */
    public function setVariableOutput(string $variableOutput)
    {
        $this->model->setVariableOutput($variableOutput);
        return $this;
    }

    /**
     * Archive a bundle for the authenticated user. Only a bundle's owner is allowed to archive a bundle.
     * 
     * @param string $budleLink
     * @return type
     */
    public function bundleArchive(string $budleLink)
    {
        $this->setPostData('bundle_link', $budleLink);
        return $this->get('bundle/archive');
    }

    /**
     * Returns a list of public bundles created by a user.
     * 
     * @param string $user
     * @param boolean $expandUser
     * @return type
     */
    public function bundleBundlesByUser(string $user, boolean $expandUser = null)
    {
        $this->setPostData('user', $user);
        $this->setPostData('expand_user', $expandUser);
        return $this->get('bundle/bundles_by_user');
    }

    /**
     * Clone a bundle for the authenticated user.
     * 
     * @param string $budleLink
     * @return type
     */
    public function bundleClone(string $budleLink)
    {
        $this->setPostData('bundle_link', $budleLink);
        return $this->get('bundle/clone');
    }

    /**
     * Add a collaborator to a bundle.
     * 
     * @param string $budleLink
     * @param string $collaborator
     * @return type
     */
    public function bundleCollaboratorAdd(string $budleLink, string $collaborator)
    {
        $this->setPostData('bundle_link', $budleLink);
        $this->setPostData('collaborator', $collaborator);
        return $this->get('bundle/collaborator_add');
    }

    /**
     * Remove a collaborator from a bundle.
     * 
     * @param string $budleLink
     * @param string $collaborator
     * @return type
     */
    public function bundleCollaboratorRemove(string $budleLink, string $collaborator)
    {
        $this->setPostData('bundle_link', $budleLink);
        $this->setPostData('collaborator', $collaborator);
        return $this->get('bundle/collaborator_remove');
    }

    /**
     * Returns information about a bundle.
     * 
     * @param string $bundleLink
     * @param boolean $expandUser
     * @return type
     */
    public function bundleContents(string $bundleLink, boolean $expandUser = null)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('expand_user', $expandUser);
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
    public function bundleCreate(boolean $private = null, string $title = null, string $description = null)
    {
        $this->setPostData('private', $private);
        $this->setPostData('title', $title);
        $this->setPostData('description', $description);
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

    /**
     * Returns all bundles this user has access to (public + private + collaborator).
     * 
     * @param boolean $expandUser
     * @return type
     */
    public function userBundleHistory(boolean $expandUser = null)
    {
        $this->setPostData('expand_user', $expandUser);
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
    public function bundleLinkAdd(string $bundleLink, string $link, string $title = null)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('title', $title);
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
    public function bundleLinkCommentAdd(string $bundleLink, string $link, string $comment)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('comment', $comment);
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
    public function bundleLinkCommentEdit(string $bundleLink, string $link, integer $commentId, string $comment)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('comment_id', $commentId);
        $this->setPostData('comment', $comment);
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
    public function bundleLinkCommentRemove(string $bundleLink, string $link, integer $commentId)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('comment_id', $commentId);
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
    public function bundleLinkEdit(string $bundleLink, string $link, string $edit, string $title = null, boolean $preview = null)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('edit', $edit);
        $this->setPostData('title', $title);
        $this->setPostData('preview', $preview);
        return $this->get('bundle/link_edit');
    }

    /**
     * Remove a link from a bitly bundle
     * 
     * @param string $bundleLink
     * @param string $link
     * @return type
     */
    public function bundleLinkRemove(string $bundleLink, string $link)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
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
    public function bundleLinkReorder(string $bundleLink, string $link, integer $displayOrder)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        $this->setPostData('display_order', $displayOrder);
        return $this->get('bundle/link_reorder');
    }

    /**
     * Removes a pending/invited collaborator from a bundle.
     * 
     * @param string $bundleLink
     * @param string $collaborator
     * @return type
     */
    public function bundlePendingCollaboratorRemove(string $bundleLink, string $collaborator)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('collaborator', $collaborator);
        return $this->get('bundle/pending_collaborator_remove');
    }

    /**
     * Re-order the links in a bundle.
     * 
     * @param string $bundleLink
     * @param string $link
     * @return type
     */
    public function bundleReorder(string $bundleLink, string $link)
    {
        $this->setPostData('bundle_link', $bundleLink);
        $this->setPostData('link', $link);
        return $this->get('bundle/reorder');
    }

    /**
     * Get the number of views for a bundle.
     * 
     * @param string $bundleLink
     * @return type
     */
    public function bundleViewCount(string $bundleLink)
    {
        $this->setPostData('bundle_link', $bundleLink);
        return $this->get('bundle/view_count');
    }

    /**
     * Given a bitly URL or hash (or multiple), returns the target (long) URL.
     * 
     * @param string $shortURLOrHash
     * @return type
     */
    public function expand(string $shortURLOrHash)
    {
        if (filter_var($shortURLOrHash, FILTER_VALIDATE_URL) === true) {
            $this->setPostData('shortUrl', $shortURLOrHash);
        } else {
            $this->setPostData('hash', $shortURLOrHash);
        }
        return $this->get('expand');
    }

    /**
     * Returns a specified number of "high-value" bitly links that are popular across bitly at this particular moment.
     * 
     * @param integer $limit
     * @return type
     */
    public function highvalue(integer $limit)
    {
        $this->setPostData('limit', $limit);
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
    public function info(string $hash, string $shortURL, boolean $expandUser)
    {
        $this->setPostData('shortUrl', $shortURL);
        $this->setPostData('hash', $hash);
        $this->setPostData('expand_user', $expandUser);
        return $this->get('info');
    }

    /**
     * Returns the detected categories for a document, in descending order of confidence.
     * 
     * @param string $link
     * @return type
     */
    public function linkCategory(string $link)
    {
        $this->setPostData('link', $link);
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

    /**
     * Returns the “main article” from the linked page, as determined by the content extractor, in either HTML or plain text format.
     * 
     * @param string $link
     * @param string $contentType
     * @return type
     */
    public function linkContent(string $link, string $contentType)
    {
        $this->setPostData('link', $link);
        $this->setPostData('content_type', $contentType);
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
    public function linkEncoders(string $link, boolean $myNetwork = null, boolean $subaccounts = null, integer $limit = null, boolean $expandUser = null)
    {
        $this->setPostData('link', $link);
        $this->setPostData('my_network', $myNetwork);
        $this->setPostData('subaccounts', $subaccounts);
        $this->setPostData('limit', $limit);
        $this->setPostData('expand_user', $expandUser);
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
    public function linkEncodersByCount(string $link, boolean $myNetwork = null, boolean $subaccounts = null, integer $limit = null, boolean $expandUser = null)
    {
        $this->setPostData('link', $link);
        $this->setPostData('my_network', $myNetwork);
        $this->setPostData('subaccounts', $subaccounts);
        $this->setPostData('limit', $limit);
        $this->setPostData('expand_user', $expandUser);
        return $this->get('link/encoders_by_count');
    }

    /**
     * Returns the number of users who have shortened (encoded) a single bitly link.
     * 
     * @param string $link
     * @return type
     */
    public function linkEncodersCount(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/encoders_count');
    }

    /**
     * Returns metadata about a single bitly link.
     * 
     * @param string $link
     * @return type
     */
    public function linkInfo(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/info');
    }

    /**
     * Returns the significant languages for the bitly link. Note that languages are highly dependent upon activity (clicks) occurring on the bitly link. If there have not been clicks on a bitly link within the last 24 hours, it is possible that language data for that link does not exist.
     * 
     * @param string $link
     * @return type
     */
    public function linkLanguage(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/language');
    }

    /**
     * Returns the significant locations for the bitly link or None if locations do not exist. Note that locations are highly dependent upon activity (clicks) occurring on the bitly link. If there have not been clicks on a bitly link within the last 24 hours, it is possible that location data for that link does not exist.
     * 
     * @param string $link
     * @return type
     */
    public function linkLocation(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/location');
    }

    /**
     * This is used to query for a bitly link based on a long URL.
     * 
     * @param string $url
     * @return type
     */
    public function linkLookup(string $url)
    {
        $this->setPostData('url', $url);
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

    /**
     * Returns the "social score" for a specified bitly link. Note that the social score are highly dependent upon activity (clicks) occurring on the bitly link. If there have not been clicks on a bitly link within the last 24 hours, it is possible a social score for that link does not exist.
     * 
     * @param string $link
     * @return type
     */
    public function linkSocial(string $link)
    {
        $this->setPostData('link', $link);
        return $this->get('link/social');
    }

    /**
     * Return information about an OAuth app.
     * 
     * @param string $clientId
     * @return type
     */
    public function oAuthApp(string $clientId)
    {
        $this->setPostData('client_id', $clientId);
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
    public function realtimeClickrate(string $phrase)
    {
        $this->setPostData('phrase', $phrase);
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

    /**
     * Given a long URL, returns a bitly short URL.
     * 
     * @param string $longURL
     * @param type $domain
     * @return type
     */
    public function shorten(string $longURL, $domain = null)
    {
        $this->setPostData('longUrl', $longURL);
        $this->setPostData('domain', $domain);
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

    /**
     * Return or update information about a user.
     * 
     * @param string $login
     * @param string $fullName
     * @return type
     */
    public function userInfo(string $login = null, string $fullName = null)
    {
        $this->setPostData('login', $login);
        $this->setPostData('full_name', $fullName);
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

    /**
     * This is used to query for a bitly link shortened by the authenticated user based on a long URL.
     * 
     * @param string $url
     * @return type
     */
    public function userLinkLookup(string $url)
    {
        $this->setPostData('url', $url);
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
    public function userLinkSave(string $longURL, string $title = null, string $note = null, boolean $private = null, integer $userTimeStamp = null)
    {
        $this->setPostData('longUrl', $longURL);
        $this->setPostData('title', $title);
        $this->setPostData('note', $note);
        $this->setPostData('private', $private);
        $this->setPostData('user_ts', $userTimeStamp);
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
    public function userNetworkHistory(integer $offset = null, boolean $expandClientId = null, integer $limit = null, boolean $expandUser = null)
    {
        $this->setPostData('offset', $offset);
        $this->setPostData('expand_client_id', $expandClientId);
        $this->setPostData('limit', $limit);
        $this->setPostData('expand_user', $expandUser);
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
    public function userPopularLinks(string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp)
    {
        $this->setPostData('unit', $unit);
        $this->setPostData('units', $units);
        $this->setPostData('timezone', $timezone);
        $this->setPostData('limit', $limit);
        $this->setPostData('unit_reference_ts', $unitReferenceTimeStamp);
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

    /**
     * Save a custom keyword for a custom short domain.
     * 
     * @param string $keywordLink
     * @param string $targetLink
     * @return type
     */
    public function userSaveCustomDomainKeyword(string $keywordLink, string $targetLink)
    {
        $this->setPostData('keyword_link', $keywordLink);
        $this->setPostData('target_link', $targetLink);
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