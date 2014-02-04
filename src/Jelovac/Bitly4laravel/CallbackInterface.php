<?php namespace Jelovac\Bitly4laravel;

interface CallbackInterface {
    
    // Data APIs
    public function highvalue(integer $limit);
    public function search(string $query, string $fields, integer $offset, integer $limit, string $domain, string  $fullDomain, string $cities, string $lang);
    public function realtimeBurstingPhrases();
    public function realtimeHotPhrases();
    public function realtimeClickrate(string $phrase);
    public function linkInfo(string $link);
    public function linkContent(string $link, string $contentType);
    public function linkCategory(string $link);
    public function linkSocial(string $link);
    public function linkLocation(string $link);
    public function linkLanguage(string $link);
    
    // Links
    public function expand(string $shortURL, string $hash);
    public function info(string $hash, string $shortURL, boolean $expandUser);
    public function linkLookup(string $url);
    public function shorten(string $longURL, $domain = null);
    public function userLinkEdit(string $link, string $edit, string $title = null, string $note = null, boolean $private = null, integer $userTimeStamp = null, boolean $archived = null);
    public function userLinkLookup(string $url);
    public function userLinkSave(string $longURL, string $title = null, string $note = null, boolean $private = null, integer $userTimeStamp = null);
    public function userSaveCustomDomainKeyword(string $keywordLink, string $targetLink);
    
    // Link metrics
    public function linkClicks(string $link, string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp);
    public function linkCountries(string $link, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function linkEncoders(string $link, boolean $myNetwork = null, boolean $subaccounts = null, integer $limit = null, boolean $expandUser = null);
    public function linkEncodersByCount(string $link, boolean $myNetwork = null, boolean $subaccounts = null, integer $limit = null, boolean $expandUser = null);
    public function linkEncodersCount(string $link);
    public function linkReferrers(string $link, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function linkReferrersByDomain(string $link, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function linkReferringDomains(string $link, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function linkShares(string $link, string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp);
    
    // User info / history
    public function oAuthApp(string $clientId);
    public function userInfo(string $login = null, string $fullName = null);
    public function userLinkHistory(string $link = null, string $query = null, integer $offset = null, integer $limit = null, integer $createdBefore = null, integer $createdAfter = null, integer $modifiedAfter = null, boolean $expandClientId = null, string $archived = null, string $private = null, string $user = null, string $exactDomain = null, string $rootDomain = null);
    public function userNetworkHistory(integer $offset = null, boolean $expandClientId = null, integer $limit = null, boolean $expandUser = null);
    public function userTrackingDomainList();
    
    // User metrics
    public function userClicks(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp);
    public function userCountries(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp);
    public function userPopularEarnedByClicks(string $domain, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function userPopularEarnedByShortens(string $domain, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function userPopularLinks(string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function userPopularOwnedByClicks(string $domain, string $subaccount, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function userPopularOwnedByShortens(string $domain, string $subaccount, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function userReferrers(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp);
    public function userReferringDomains(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp);
    public function userShareCounts(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp);
    public function userShareCountsByShareType(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp);
    public function userShortenCounts(string $unit, integer $units, string $timezone, boolean $rollup, integer $limit, integer $unitReferenceTimeStamp);
    
    // Organization Metrics
    public function organizationBrandMessages(string $domain, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function organizationIntersectingLinks(string $domain, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function organizationLeaderboard(string $domain, string $orderBy, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    public function organizationMissedOpportunities(string $domain, string $unit, integer $units, string $timezone, integer $limit, integer $unitReferenceTimeStamp);
    
    // Bundles
    public function bundleArchive(string $budleLink);
    public function bundleBundlesByUser(string $user, boolean $expandUser = null);
    public function bundleClone(string $budleLink);
    public function bundleCollaboratorAdd(string $budleLink, string $collaborator);
    public function bundleCollaboratorRemove(string $budleLink, string $collaborator);
    public function bundleContents(string $bundleLink, boolean $expandUser = null);
    public function bundleCreate(boolean $private = null, string $title = null, string $description = null);
    public function bundleEdit(string $bundleLink, string $edit = null, string $title = null, string $description = null, boolean $private = null, boolean $preview = null, string $ogImage = null);
    public function bundleLinkAdd(string $bundleLink, string $link, string $title = null);
    public function bundleLinkCommentAdd(string $bundleLink, string $link, string $comment);
    public function bundleLinkCommentEdit(string $bundleLink, string $link, integer $commentId, string $comment);
    public function bundleLinkCommentRemove(string $bundleLink, string $link, integer $commentId);
    public function bundleLinkEdit(string $bundleLink, string $link, string $edit, string $title = null, boolean $preview = null);
    public function bundleLinkRemove(string $bundleLink, string $link);
    public function bundleLinkReorder(string $bundleLink, string $link, integer $displayOrder);
    public function bundlePendingCollaboratorRemove(string $bundleLink, string $collaborator);
    public function bundleReorder(string $bundleLink, string $link);
    public function bundleViewCount(string $bundleLink);
    public function bundleHistory(boolean $expandUser = null);
    
}