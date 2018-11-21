import '../../stencil.core';
export declare class JhStImg {
    el: HTMLElement;
    alt: string;
    imgClass: string;
    src: string;
    srcset: string;
    sources: any;
    _hasIntersectionObserver: boolean;
    _isHandleImageFallback: boolean;
    _sources: {
        sizes: string;
        srcset: string;
        type: string;
        media: string;
    }[];
    srcWatchHandler(): void;
    srcsetWatchHandler(): void;
    sourcesWatchHandler(): void;
    documentScrollHandler(): void;
    windowResizeHandler(): void;
    windowRrientationchangeHandler(): void;
    io: IntersectionObserver;
    componentWillLoad(): void;
    componentDidLoad(): void;
    componentDidUnload(): void;
    handleImage(): void;
    fallbackLazyLoad(): void;
    addIntersectionObserver(): void;
    removeIntersectionObserver(): void;
    render(): JSX.Element;
}
