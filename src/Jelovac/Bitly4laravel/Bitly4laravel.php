<?php

namespace Jelovac\Bitly4laravel;

class Bitly4laravel extends API implements BitlyInterface
{

    /**
     * Archive a bundle for the authenticated user. Only a bundle's owner is allowed to archive a bundle.
     *
     * @param string $budleLink
     * @return type
     */
    public function bundleArchive($budleLink)
    {
        return $this->make('bundle/archive', array(
                    'bundle_link' => $budleLink
        ));
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
        $params = array('user' => $user);

        if ($expandUser !== null) {
            $params['expand_user'] = $expandUser;
        }

        return $this->make('bundle/bundles_by_user', $params);
    }

    /**
     * Clone a bundle for the authenticated user.
     *
     * @param string $budleLink
     * @return type
     */
    public function bundleClone($budleLink)
    {
        return $this->make('bundle/clone', array('bundle_link', $budleLink));
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
        return $this->make('bundle/collaborator_add', array(
                    'bundle_link' => $budleLink,
                    'collaborator' => $collaborator,
        ));
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
        return $this->make('bundle/collaborator_remove', array(
                    'bundle_link' => $budleLink,
                    'collaborator' => $collaborator
        ));
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
        $params = array('bundle_link' => $bundleLink);

        if ($expandUser !== null) {
            $params['expand_user'] = $expandUser;
        }

        return $this->make('bundle/contents', $params);
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
        $params = array();

        if ($private !== null) {
            $params['private'] = $private;
        }

        if ($title !== null) {
            $params['title'] = $title;
        }

        if ($description !== null) {
            $params['description'] = $description;
        }

        return $this->make('bundle/create', $params);
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
        $params = array('bundle_link' => $bundleLink);

        if ($edit !== null) {
            $params['edit'] = $edit;
        }

        if ($title !== null) {
            $params['title'] = $title;
        }

        if ($description !== null) {
            $params['description'] = $description;
        }

        if ($private !== null) {
            $params['private'] = $private;
        }

        if ($preview !== null) {
            $params['preview'] = $preview;
        }

        if ($ogImage !== null) {
            $params['og_image'] = $ogImage;
        }

        return $this->make('bundle/edit', $params);
    }

    /**
     * Returns all bundles this user has access to (public + private + collaborator).
     *
     * @param boolean $expandUser
     * @return type
     */
    public function userBundleHistory($expandUser = null)
    {
        $params = array();

        if ($expandUser !== null) {
            $params['expand_user'] = $expandUser;
        }

        return $this->make('user/bundle_history', $params);
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
        $params = array(
            'bundle_link' => $bundleLink,
            'link' => $link,
        );

        if ($title !== null) {
            $params['title'] = $title;
        }

        return $this->make('bundle/link_add', $params);
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
        return $this->make('bundle/link_comment_add', array(
                    'bundle_link' => $bundleLink,
                    'link' => $link,
                    'comment' => $comment,
        ));
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
        return $this->make('bundle/link_comment_edit', array(
                    'bundle_link' => $bundleLink,
                    'link' => $link,
                    'comment_id' => $commentId,
                    'comment' => $comment,
        ));
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
        return $this->make('bundle/link_comment_remove', array(
                    'bundle_link' => $bundleLink,
                    'link' => $link,
                    'comment_id' => $commentId,
        ));
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
        $params = array(
            'bundle_link' => $bundleLink,
            'link' => $link,
            'edit' => $edit,
        );

        if ($title !== null) {
            $params['title'] = $title;
        }

        if ($preview !== null) {
            $params['preview'] = $preview;
        }

        return $this->make('bundle/link_edit', $params);
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
        return $this->make('bundle/link_remove', array(
                    'bundle_link' => $bundleLink,
                    'link' => $link,
        ));
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
        return $this->make('bundle/link_reorder', array(
                    'bundle_link' => $bundleLink,
                    'link' => $link,
                    'display_order' => $displayOrder,
        ));
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
        return $this->make('bundle/pending_collaborator_remove', array(
                    'bundle_link' => $bundleLink,
                    'collaborator' => $collaborator,
        ));
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
        return $this->make('bundle/reorder', array(
                    'bundle_link' => $bundleLink,
                    'link' => $link,
        ));
    }

    /**
     * Get the number of views for a bundle.
     *
     * @param string $bundleLink
     * @return type
     */
    public function bundleViewCount($bundleLink)
    {
        return $this->make('bundle/view_count', array(
                    'bundle_link' => $bundleLink,
        ));
    }

    /**
     * Given a bitly URL or hash (or multiple), returns the target (long) URL.
     *
     * @param string $shortURLOrHash
     * @return type
     */
    public function expand($shortURLOrHash)
    {
        $params = array();

        if (filter_var($shortURLOrHash, FILTER_VALIDATE_URL) === false) {
            $params['hash'] = $shortURLOrHash;
        } else {
            $params['shortUrl'] = $shortURLOrHash;
        }

        return $this->make('expand', $params);
    }

    /**
     * Returns a specified number of "high-value" bitly links that are popular across bitly at this particular moment.
     *
     * @param integer $limit
     * @return type
     */
    public function highvalue($limit = null)
    {
        $params = array();

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        return $this->make('highvalue', $params);
    }

    /**
     * This is used to return the page title for a given bitly link.
     *
     * @param string $hash
     * @param string $shortURL
     * @param boolean $expandUser
     * @return type
     */
    public function info($shortURLOrHash, $expandUser = null)
    {
        $params = array();

        if (filter_var($shortURLOrHash, FILTER_VALIDATE_URL) === false) {
            $params['hash'] = $shortURLOrHash;
        } else {
            $params['shortUrl'] = $shortURLOrHash;
        }

        if ($expandUser !== null) {
            $params['expand_user'] = $expandUser;
        }

        return $this->make('info', $params);
    }

    /**
     * Returns the detected categories for a document, in descending order of confidence.
     *
     * @param string $link
     * @return type
     */
    public function linkCategory($link)
    {
        return $this->make('link/category', array(
                    'link' => $link,
        ));
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
    public function linkClicks($link, $unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array('link' => $link);

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($rollup !== null) {
            $params['rollup'] = $rollup;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('link/clicks', $params);
    }

    /**
     * Returns the “main article” from the linked page, as determined by the content extractor, in either HTML or plain text format.
     *
     * @param string $link
     * @param string $contentType
     * @return type
     */
    public function linkContent($link, $contentType = null)
    {
        $params = array('link' => $link);

        if ($contentType !== null) {
            $params['content_type'] = $contentType;
        }

        return $this->make('link/content', $params);
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
    public function linkCountries($link, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array('link' => $link);

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('link/countries', $params);
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
        $params = array('link' => $link);

        if ($myNetwork !== null) {
            $params['my_network'] = $myNetwork;
        }

        if ($subaccounts !== null) {
            $params['subaccounts'] = $subaccounts;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($expandUser !== null) {
            $params['expand_user'] = $expandUser;
        }

        return $this->make('link/encoders', $params);
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
        $params = array('link' => $link);

        if ($myNetwork !== null) {
            $params['my_network'] = $myNetwork;
        }

        if ($subaccounts !== null) {
            $params['subaccounts'] = $subaccounts;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($expandUser !== null) {
            $params['expand_user'] = $expandUser;
        }

        return $this->make('link/encoders_by_count', $params);
    }

    /**
     * Returns the number of users who have shortened (encoded) a single bitly link.
     *
     * @param string $link
     * @return type
     */
    public function linkEncodersCount($link)
    {
        return $this->make('link/encoders_count', array(
                    'link' => $link,
        ));
    }

    /**
     * Returns metadata about a single bitly link.
     *
     * @param string $link
     * @return type
     */
    public function linkInfo($link)
    {
        return $this->make('link/info', array(
                    'link' => $link,
        ));
    }

    /**
     * Returns the significant languages for the bitly link. Note that languages are highly dependent upon activity (clicks) occurring on the bitly link. If there have not been clicks on a bitly link within the last 24 hours, it is possible that language data for that link does not exist.
     *
     * @param string $link
     * @return type
     */
    public function linkLanguage($link)
    {
        return $this->make('link/language', array(
                    'link' => $link,
        ));
    }

    /**
     * Returns the significant locations for the bitly link or None if locations do not exist. Note that locations are highly dependent upon activity (clicks) occurring on the bitly link. If there have not been clicks on a bitly link within the last 24 hours, it is possible that location data for that link does not exist.
     *
     * @param string $link
     * @return type
     */
    public function linkLocation($link)
    {
        return $this->make('link/location', array(
                    'link' => $link,
        ));
    }

    /**
     * This is used to query for a bitly link based on a long URL.
     *
     * @param string $url
     * @return type
     */
    public function linkLookup($url)
    {
        return $this->make('link/lookup', array(
                    'url' => $url,
        ));
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
    public function linkReferrers($link, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array('link' => $link);

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('link/referrers', $params);
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
    public function linkReferrersByDomain($link, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array('link' => $link);

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('link/referrers_by_domain', $params);
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
    public function linkReferringDomains($link, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array('link' => $link);

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('link/referring_domains', $params);
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
    public function linkShares($link, $unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array('link' => $link);

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('link/shares', $params);
    }

    /**
     * Returns the "social score" for a specified bitly link. Note that the social score are highly dependent upon activity (clicks) occurring on the bitly link. If there have not been clicks on a bitly link within the last 24 hours, it is possible a social score for that link does not exist.
     *
     * @param string $link
     * @return type
     */
    public function linkSocial($link)
    {
        return $this->make('link/social', array(
                    'link' => $link,
        ));
    }

    /**
     * Return information about an OAuth app.
     *
     * @param string $clientId
     * @return type
     */
    public function oAuthApp($clientId)
    {
        return $this->make('oauth/app', array(
                    'client_id' => $clientId,
        ));
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
    public function organizationBrandMessages($domain = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('organization/brand_messages', $params);
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
    public function organizationIntersectingLinks($domain = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('organization/interesecting_links', $params);
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
    public function organizationLeaderboard($domain = null, $orderBy = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        if ($orderBy !== null) {
            $params['order_by'] = $orderBy;
        }

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('organization/leaderboard', $params);
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
    public function organizationMissedOpportunities($domain = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('organization/missed_opportunities', $params);
    }

    /**
     * Returns phrases that are receiving an uncharacteristically high volume of click traffic, and the individual links (hashes) driving traffic to pages containing these phrases.
     *
     * @return type
     */
    public function realtimeBurstingPhrases()
    {
        return $this->make('realtime/bursting_phrases');
    }

    /**
     * Returns the click rate for content containing a specified phrase.
     *
     * @param string $phrase
     * @return type
     */
    public function realtimeClickrate($phrase)
    {
        return $this->make('realtime/clickrate', array(
                    'phrase' => $phrase,
        ));
    }

    /**
     * Returns phrases that are receiving a consistently high volume of click traffic, and the individual links (hashes) driving traffic to pages containing these phrases.
     *
     * @return type
     */
    public function realtimeHotPhrases()
    {
        return $this->make('realtime/hot_phrases');
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
    public function search($query, $domain, $fields = null, $offset = null, $limit = null, $fullDomain = null, $cities = null, $lang = null)
    {
        $params = array(
            'query' => $query,
            'domain' => $domain,
        );

        if ($fields !== null) {
            $params['fields'] = $fields;
        }

        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($fullDomain !== null) {
            $params['full_domain'] = $fullDomain;
        }

        if ($cities !== null) {
            $params['cities'] = $cities;
        }

        if ($lang !== null) {
            $params['lang'] = $lang;
        }

        return $this->make('search', $params);
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
        $params = array('longUrl' => $longURL);

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        return $this->make('shorten', $params);
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
    public function userClicks($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($rollup !== null) {
            $params['rollup'] = $rollup;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/clicks', $params);
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
    public function userCountries($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($rollup !== null) {
            $params['rollup'] = $rollup;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/countries', $params);
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
        $params = array();

        if ($login !== null) {
            $params['login'] = $login;
        }

        if ($fullName !== null) {
            $params['full_name'] = $fullName;
        }

        return $this->make('user/info', $params);
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
        $params = array(
            'link' => $link,
            'edit' => $edit,
        );

        if ($title !== null) {
            $params['title'] = $title;
        }

        if ($note !== null) {
            $params['note'] = $note;
        }

        if ($private !== null) {
            $params['private'] = $private;
        }

        if ($userTimeStamp !== null) {
            $params['user_ts'] = $userTimeStamp;
        }

        if ($archived !== null) {
            $params['archived'] = $archived;
        }

        return $this->make('user/link_edit', $params);
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
        $params = array();

        if ($link !== null) {
            $params['link'] = $link;
        }

        if ($query !== null) {
            $params['query'] = $query;
        }

        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($createdBefore !== null) {
            $params['created_before'] = $createdBefore;
        }

        if ($createdAfter !== null) {
            $params['created_after'] = $createdAfter;
        }

        if ($modifiedAfter !== null) {
            $params['modified_after'] = $modifiedAfter;
        }

        if ($expandClientId !== null) {
            $params['expand_client_id'] = $expandClientId;
        }

        if ($archived !== null) {
            $params['archived'] = $archived;
        }

        if ($private !== null) {
            $params['private'] = $private;
        }

        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        if ($user !== null) {
            $params['user'] = $user;
        }

        if ($exactDomain !== null) {
            $params['exact_domain'] = $exactDomain;
        }

        if ($rootDomain !== null) {
            $params['root_domain'] = $rootDomain;
        }

        return $this->make('user/link_history', $params);
    }

    /**
     * This is used to query for a bitly link shortened by the authenticated user based on a long URL.
     *
     * @param string $url
     * @return type
     */
    public function userLinkLookup($url)
    {
        return $this->make('user/link_lookup', array(
                    'url' => $url,
        ));
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
        $params = array('longUrl' => $longURL);

        if ($title !== null) {
            $params['title'] = $title;
        }

        if ($note !== null) {
            $params['note'] = $note;
        }

        if ($private !== null) {
            $params['private'] = $private;
        }

        if ($userTimeStamp !== null) {
            $params['user_ts'] = $userTimeStamp;
        }

        return $this->make('user/link_save', $params);
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
        $params = array();

        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        if ($expandClientId !== null) {
            $params['expand_client_id'] = $expandClientId;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($expandUser !== null) {
            $params['expand_user'] = $expandUser;
        }

        return $this->make('user/newtork_history', $params);
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
    public function userPopularEarnedByClicks($domain = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/popular_earned_by_clicks', $params);
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
    public function userPopularEarnedByShortens($domain = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/popular_earned_by_shortens', $params);
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
    public function userPopularLinks($unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/popular_links', $params);
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
    public function userPopularOwnedByClicks($domain = null, $subaccount = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        if ($subaccount !== null) {
            $params['subaccount'] = $subaccount;
        }

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/popular_owned_by_clicks', $params);
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
    public function userPopularOwnedByShortens($domain = null, $subaccount = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($domain !== null) {
            $params['domain'] = $domain;
        }

        if ($subaccount !== null) {
            $params['subaccount'] = $subaccount;
        }

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/popular_owned_by_shortens', $params);
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
    public function userReferrers($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($rollup !== null) {
            $params['rollup'] = $rollup;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/referrers', $params);
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
    public function userReferringDomains($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($rollup !== null) {
            $params['rollup'] = $rollup;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/referring_domains', $params);
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
        return $this->make('user/save_custom_domain_keyword', array(
                    'keyword_link' => $keywordLink,
                    'target_link' => $targetLink,
        ));
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
    public function userShareCounts($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($rollup !== null) {
            $params['rollup'] = $rollup;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/share_counts', $params);
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
    public function userShareCountsByShareType($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($rollup !== null) {
            $params['rollup'] = $rollup;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/share_counts_by_share_type', $params);
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
    public function userShortenCounts($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array();

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($rollup !== null) {
            $params['rollup'] = $rollup;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/shorten_counts', $params);
    }

    /**
     * Returns a list of tracking domains a user has configured.
     *
     * @return type
     */
    public function userTrackingDomainList()
    {
        return $this->make('user/tracking_domain_list');
    }

    /**
     * Query whether a given domain is a valid bitly pro domain.
     * Keep in mind that bitly custom short domains are restricted
     * to less than 15 characters in length.
     *
     * @param string $domain
     * @return type
     */
    public function domainBitlyProDomain($domain)
    {
        return $this->make('bitly_pro_domain', array(
                    'domain' => $domain,
        ));
    }

    /**
     * This lists NSQ Topic and Channel Message Information and Connection State for a Topic.
     *
     * @param type $topic NSQ Data Stream Topic
     * @return type
     */
    public function nsqStats($topic)
    {
        return $this->make('nsq/stats', array(
                    'topic' => $topic,
        ));
    }

    /**
     * Returns the number of clicks on Bitlinks pointing to the specified
     * tracking domain that have occured in a given time period.
     * Users can register a tracking domain from their bitly settings page.
     *
     * @param string $domain
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userTrackingDomainClicks($domain, $unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array('domain' => $domain);

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($rollup !== null) {
            $params['rollup'] = $rollup;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/tracking_domain_clicks', $params);
    }

    /**
     * Returns the number of links, pointing to a specified tracking domain,
     * shortened (encoded) in a given time period by all bitly users.
     * Users can register a tracking domain from their bitly settings page.
     *
     * @param string $domain
     * @param string $unit
     * @param integer $units
     * @param string $timezone
     * @param boolean $rollup
     * @param integer $limit
     * @param integer $unitReferenceTimeStamp
     * @return type
     */
    public function userTrackingDomainShortenCounts($domain, $unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null)
    {
        $params = array('domain' => $domain);

        if ($unit !== null) {
            $params['unit'] = $unit;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }

        if ($rollup !== null) {
            $params['rollup'] = $rollup;
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($unitReferenceTimeStamp !== null) {
            $params['unit_reference_ts'] = $unitReferenceTimeStamp;
        }

        return $this->make('user/tracking_domain_shorten_counts', $params);
    }

}
