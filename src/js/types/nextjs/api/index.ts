// This file is autogenerated – run `ant apidocs` to update it

import {
    Configuration as NextJsApiLayoutElementConfiguration,
} from './layoutelement/'

import {
    Configuration as NextJsApiTasticConfiguration,
} from './tastic/'

/**
 * Context retrieved by an "action" extension.
 *
 * All fields in the context are optional. We want to introduce a mechanism in the future that allows extensions to
 * annotate which context data they require.
 */
export interface ActionContext {
     frontasticContext?: Context;
}

/**
 * Base configuration properties for rendered elements of a page.
 */
export interface Configuration {
     mobile: boolean;
     tablet: boolean;
     desktop: boolean;
}

/**
 * Frontastic context that an API hub server is running in (project & environment).
 *
 * Includes environment information configuration on ba
 */
export interface Context {
     /**
      * One of "production", "staging" or "development".
      */
     environment: string;
     project: Project;
     /**
      * Additional project configuration from Frontastic studio.
      *
      * TODO: This is not completed right now.
      */
     projectConfiguration: any;
     /**
      * The currently set locale by the user in the frontend.
      */
     locale: string;
     /**
      * Feature flags mapped to their state.
      */
     featureFlags: Record<string, boolean> | [];
}

/**
 * Representation of a data source configuration on a PageFolder.
 */
export interface DataSourceConfiguration {
     dataSourceId: string;
     type: string;
     name: string;
     configuration: any;
}

/**
 * Context retrieved by a "data-source" extension.
 *
 * All fields in the context are optional. We want to introduce a mechanism in the future that allows extensions to
 * annotate which context data they require.
 */
export interface DataSourceContext {
     frontasticContext?: Context;
     /**
      * The page folder being rendered.
      */
     pageFolder?: PageFolder;
     /**
      * The page being rendered.
      */
     page?: Page;
     /**
      * Tastics on the page which are using this data source.
      */
     usingTastics?: Tastic[] | null;
     request?: Request;
     /**
      * Denotes whether a request is coming from the /frontastic/data-source-preview
      * Useful for determining when to send back a proper pagePreviewPayload.
      */
     isPreview?: boolean;
}

export interface DataSourcePreviewPayloadElement {
     /**
      * This will show up as the name of the element in the
      * data source preview list in Studio.
      */
     title: string;
     /**
      * This is the image URL that will be loaded when viewing
      * the data source preview list in Studio.
      */
     image?: string;
}

/**
 * Return type for "data-source" extensions. Can contain any payload, depending on the data source.
 *
 * Different data source implementations
 */
export interface DataSourceResult {
     /**
      * Arbitrary (JSON serializable) payload information returned by the data source.
      *
      * This payload will be transmitted to the Tastics which are assigned to the corresponding data source in the
      * frontend. IMPORTANT: The payload must be JSON serializable (and therefore e.g. must not contain cyclic
      * references).
      */
     dataSourcePayload: any;
     /**
      * Studio will get the data when showing the data source previews from this array.
      *
      * To increase performance it is recommended to only set this when the data source is requested with
      * the DataSourceContext.isPreview property is true.
      */
     previewPayload?: DataSourcePreviewPayloadElement[];
}

/**
 * Context retrieved by the "dynamic-page-handler" extension.
 *
 * All fields in the context are optional. We want to introduce a mechanism in the future that allows extensions to
 * annotate which context data they require.
 */
export interface DynamicPageContext {
     frontasticContext?: Context;
}

/**
 * Can be used to redirect to a different path on the website.
 *
 * This is, for example, useful to update the URL of a product detail page when the SEO slug of the product changes.
 */
export interface DynamicPageRedirectResult {
     redirectLocation: string;
     statusCode?: number;
     /**
      * Allows to override the standard HTTP status message.
      */
     statusMessage?: string;
     /**
      * Allows specifying additional headers for the redirect.
      *
      * The format for this map is to assign a string to a corresponding header key, for example:
      * {
      *     "Retry-After": "120"
      * }
      */
     additionalResponseHeaders?: Record<string, string> | [];
}

/**
 * Determines what type of dynamic page is matched and delivers the payload of the __master data source.
 */
export interface DynamicPageSuccessResult {
     /**
      * Unique identifier for the page type matched. Will correlate with configuration in Frontastic studio.
      */
     dynamicPageType: string;
     /**
      * Payload for the main (__master) data source of the dynamic page.
      *
      * The content of this field must be JSON serializable (e.g. does not have cyclic references).
      */
     dataSourcePayload: any;
     /**
      * Submit a payload Frontastic uses for scheduled page criterion matching (FECL)
      *
      * The content of this field must be JSON serializable (e.g. does not have cyclic references).
      */
     pageMatchingPayload?: any;
}

export interface LayoutElement {
     layoutElementId: string;
     configuration: NextJsApiLayoutElementConfiguration;
     tastics: Tastic[];
}

export interface Page {
     pageId: string;
     sections: Section[];
     /**
      * One of "published", "draft" or "scheduled"
      */
     state: string;
}

export interface PageFolder {
     pageFolderId: string;
     isDynamic: boolean;
     pageFolderType: string;
     configuration: any;
     dataSourceConfigurations: DataSourceConfiguration[];
     name?: string;
     /**
      * Materialized path of IDs of ancestor page folders.
      */
     ancestorIdsMaterializedPath: string;
     /**
      * Depth of this page folder in the page folder tree.
      */
     depth: number;
     /**
      * Sort order in the page folder tree.
      */
     sort: number;
     breadcrumbs?: PageFolderBreadcrumb[];
}

export interface PageFolderBreadcrumb {
     pageFolderId: string;
     pathTranslations?: any;
     ancestorIdsMaterializedPath?: string;
}

/**
 * Project information and configuration as determined by Frontastic.
 */
export interface Project {
     projectId: string;
     name: string;
     customer: string;
     /**
      * Configuration options determined by the project.yml.
      */
     configuration: any;
     locales: string[];
     defaultLocale: string;
}

/**
 * Request as coming in to the Frontastci API hub.
 *
 * The request structure is inspired by Express.js version 4.x and contains additional Frontastic $sessionData.
 */
export interface Request {
     /**
      * Will be JSON-decoded on the JS side and hold an object there.
      */
     body?: string;
     hostname?: string;
     method: string;
     path: string;
     query: any;
     clientIp?: string;
     headers?: Record<string, string> | [];
     frontasticRequestId?: string;
     /**
      * Frontastic session data.
      */
     sessionData?: null | any;
}

/**
 * Response as to be returned by an "action" extension.
 *
 * The response structure is inspired by Express.js version 4.x + Frontastic sessionData.
 * IMPORTANT: To retain session information you need to return the session that comes in through sessionData in a
 * request in the response of the action.
 */
export interface Response {
     statusCode: number;
     body?: string;
     /**
      * Frontastic session data to be written.
      */
     sessionData?: null | any;
}

export interface Section {
     sectionId: string;
     layoutElements?: LayoutElement[];
}

export interface Tastic {
     /**
      * Unique on the page. Might be used for #href links.
      */
     tasticId: string;
     /**
      * Type as defined in the Tastic schema.
      */
     tasticType: string;
     configuration: NextJsApiTasticConfiguration;
}
