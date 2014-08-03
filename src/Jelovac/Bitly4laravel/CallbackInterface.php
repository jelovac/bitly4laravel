<?php namespace Jelovac\Bitly4laravel;

interface CallbackInterface {
    
    // Data APIs
    public function highvalue($limit = null);
    public function search($query, $domain, $fields = null, $offset = null, $limit = null,  $fullDomain = null, $cities = null, $lang = null);
    public function realtimeBurstingPhrases();
    public function realtimeHotPhrases();
    public function realtimeClickrate($phrase);
    public function linkInfo($link);
    public function linkContent($link, $contentType = null);
    public function linkCategory($link);
    public function linkSocial($link);
    public function linkLocation($link);
    public function linkLanguage($link);
    
    // Links
    public function expand($shortURLOrHash);
    public function info($shortURLOrHash, $expandUser = null);
    public function linkLookup($url);
    public function shorten($longURL, $domain = null);
    public function userLinkEdit($link, $edit, $title = null, $note = null, $private = null, $userTimeStamp = null, $archived = null);
    public function userLinkLookup($url);
    public function userLinkSave($longURL, $title = null, $note = null, $private = null, $userTimeStamp = null);
    public function userSaveCustomDomainKeyword($keywordLink, $targetLink);
    
    // Link metrics
    public function linkClicks($link, $unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    public function linkCountries($link, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function linkEncoders($link, $myNetwork = null, $subaccounts = null, $limit = null, $expandUser = null);
    public function linkEncodersByCount($link, $myNetwork = null, $subaccounts = null, $limit = null, $expandUser = null);
    public function linkEncodersCount($link);
    public function linkReferrers($link, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function linkReferrersByDomain($link, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function linkReferringDomains($link, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function linkShares($link, $unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    
    // User info / history
    public function oAuthApp($clientId);
    public function userInfo($login = null, $fullName = null);
    public function userLinkHistory($link = null, $query = null, $offset = null, $limit = null, $createdBefore = null, $createdAfter = null, $modifiedAfter = null, $expandClientId = null, $archived = null, $private = null, $user = null, $exactDomain = null, $rootDomain = null);
    public function userNetworkHistory($offset = null, $expandClientId = null, $limit = null, $expandUser = null);
    public function userTrackingDomainList();
    
    // User metrics
    public function userClicks($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userCountries($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userPopularEarnedByClicks($domain, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userPopularEarnedByShortens($domain, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userPopularLinks($unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userPopularOwnedByClicks($domain, $subaccount, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userPopularOwnedByShortens($domain, $subaccount, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userReferrers($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userReferringDomains($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userShareCounts($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userShareCountsByShareType($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userShortenCounts($unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    
    // Organization Metrics
    public function organizationBrandMessages($domain = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function organizationIntersectingLinks($domain = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function organizationLeaderboard($domain = null, $orderBy = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    public function organizationMissedOpportunities($domain = null, $unit = null, $units = null, $timezone = null, $limit = null, $unitReferenceTimeStamp = null);
    
    // Bundles
    public function bundleArchive($budleLink);
    public function bundleBundlesByUser($user, $expandUser = null);
    public function bundleClone($budleLink);
    public function bundleCollaboratorAdd($budleLink, $collaborator);
    public function bundleCollaboratorRemove($budleLink, $collaborator);
    public function bundleContents($bundleLink, $expandUser = null);
    public function bundleCreate($private = null, $title = null, $description = null);
    public function bundleEdit($bundleLink, $edit = null, $title = null, $description = null, $private = null, $preview = null, $ogImage = null);
    public function bundleLinkAdd($bundleLink, $link, $title = null);
    public function bundleLinkCommentAdd($bundleLink, $link, $comment);
    public function bundleLinkCommentEdit($bundleLink, $link, $commentId, $comment);
    public function bundleLinkCommentRemove($bundleLink, $link, $commentId);
    public function bundleLinkEdit($bundleLink, $link, $edit, $title = null, $preview = null);
    public function bundleLinkRemove($bundleLink, $link);
    public function bundleLinkReorder($bundleLink, $link, $displayOrder);
    public function bundlePendingCollaboratorRemove($bundleLink, $collaborator);
    public function bundleReorder($bundleLink, $link);
    public function bundleViewCount($bundleLink);
    public function userBundleHistory($expandUser = null);
    
    // Domains
    public function domainBitlyProDomain($domain);
    public function userTrackingDomainClicks($domain, $unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    public function userTrackingDomainShortenCounts($domain, $unit = null, $units = null, $timezone = null, $rollup = null, $limit = null, $unitReferenceTimeStamp = null);
    
    // Data Streams
    public function nsqLookup();
    public function nsqStats($topic);
}